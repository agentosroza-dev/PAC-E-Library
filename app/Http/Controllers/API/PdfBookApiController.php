<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PdfBook;
use App\Models\PdfBookmark;
use App\Models\PdfCategory;
use App\Models\PdfFavorite;
use App\Models\PdfReadingHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfBookApiController extends Controller
{
    /**
     * Number of items per page
     */
    const DEFAULT_PER_PAGE = 15;

    const MAX_PER_PAGE = 100;

    /**
     * Maximum file sizes (in KB)
     */
    const MAX_IMAGE_SIZE = 2048; // 2MB

    const MAX_PDF_SIZE = 10240; // 10MB

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|in:0,1,true,false', // Changed from 'boolean' to accept string values
            'category_id' => 'nullable|exists:pdf_categories,id',
            'uploaded_by' => 'nullable|exists:users,id',
            'search' => 'nullable|string|max:100',
            'sort_field' => 'nullable|string|in:title,created_at,updated_at,version,downloads,userview',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:1|max:'.self::MAX_PER_PAGE,
            'with_favorites' => 'nullable|in:true,false,1,0',
            'with_bookmarks' => 'nullable|boolean',
            'with_reading_histories' => 'nullable|boolean',
            'min_downloads' => 'nullable|integer|min:0',
            'max_downloads' => 'nullable|integer|min:0',
            'created_after' => 'nullable|date',
            'created_before' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid parameters', $validator->errors(), 422);
        }

        // Start query with base relationships
        $query = PdfBook::with(['category:id,title', 'uploader:id,name']);

        // Add favorite count to all books
        $query->withCount('favorites');

        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            // Convert string boolean to actual boolean
            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($status !== null) {
                $query->where('status', $status);
            }
        }

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('uploaded_by') && $request->uploaded_by) {
            $query->where('uploaded_by', $request->uploaded_by);
        }

        // Apply sorting
        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Conditionally load additional relationships
        if ($request->boolean('with_favorites') && Auth::check()) {
            $query->with(['favorites' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);
        }

        if ($request->boolean('with_bookmarks') && Auth::check()) {
            $query->with(['bookmarks' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);
        }

        if ($request->boolean('with_reading_histories') && Auth::check()) {
            $query->with(['readingHistories' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);
        }

        // Pagination
        $perPage = $request->get('per_page', self::DEFAULT_PER_PAGE);
        $pdfBooks = $query->paginate($perPage);

        // Add full URLs and user-specific flags
        $pdfBooks->getCollection()->transform(function ($book) {
            $book = $this->addFileUrls($book);

            if (Auth::check()) {
                $book->is_favorited = $book->favorites->isNotEmpty(); // Checks ONLY current user
                $book->total_bookmarks = $book->bookmarks->count();
                $book->reading_progress = $book->readingHistories->first()->reading_progress ?? 0;
                $book->last_read_page = $book->readingHistories->first()->last_page ?? null;
            }

            $book->favorite_count = $book->favorites_count ?? 0;

            return $book;
        });

        return $this->successResponse(
            $pdfBooks,
            'PDF Books retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // Debug: Log the request method and data
        \Log::info('Store method called', [
            'method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'has_file' => $request->hasFile('file'),
            'all_data' => $request->all(),
        ]);

        // Check if this is a POST request
        if (! $request->isMethod('post')) {
            return $this->errorResponse(
                'Method not allowed. Use POST.',
                null,
                405
            );
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:pdf_categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:'.self::MAX_IMAGE_SIZE,
            'file' => 'required|mimes:pdf|max:'.self::MAX_PDF_SIZE,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        $validated = $validator->validated();

        try {
            // Handle image upload
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('pdf-books/images', 'public');
                $validated['image'] = $imagePath;
                \Log::info('Image uploaded', ['path' => $imagePath]);
            }

            // Handle PDF file upload
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $filePath = $request->file('file')->store('pdf-books/files', 'public');
                $validated['file'] = $filePath;
                \Log::info('PDF uploaded', ['path' => $filePath]);
            } else {
                return $this->errorResponse('PDF file is required or invalid', null, 422);
            }

            // Set uploaded_by to current user
            $validated['uploaded_by'] = Auth::id();

            // Set default status if not provided
            $validated['status'] = $request->has('status')
                ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN)
                : false;

            // Set default values
            $validated['downloads'] = 0;
            $validated['userview'] = 0;

            // Set default version if not provided
            if (! isset($validated['version']) || empty($validated['version'])) {
                $validated['version'] = '1.0.0';
            }

            // Create the book
            $pdfBook = PdfBook::create($validated);
            \Log::info('Book created', ['id' => $pdfBook->id]);

            // Load relationships
            $pdfBook->load(['category:id,title', 'uploader:id,name']);

            // Add file URLs
            $pdfBook = $this->addFileUrls($pdfBook);

            return $this->successResponse(
                $pdfBook,
                'PDF Book created successfully',
                201
            );

        } catch (\Exception $e) {
            \Log::error('Error creating book', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->errorResponse(
                'Failed to create book: '.$e->getMessage(),
                null,
                500
            );
        }
    }

    /*
    * @param  int  $id
    */
    public function show($id): JsonResponse
    {
        $pdfBook = PdfBook::with([
            'category:id,title',
            'uploader:id,name',
            'favorites' => function ($q) {
                if (Auth::check()) {
                    $q->where('user_id', Auth::id());
                }
            },
            'bookmarks' => function ($q) {
                if (Auth::check()) {
                    $q->where('user_id', Auth::id());
                }
            },
            'readingHistories' => function ($q) {
                if (Auth::check()) {
                    $q->where('user_id', Auth::id());
                }
            },
        ])
            ->withCount(['favorites', 'readingHistories'])
            ->find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        // Add user-specific flags if authenticated
        if (Auth::check()) {
            $pdfBook->is_favorited = $pdfBook->favorites->isNotEmpty();
            $pdfBook->total_bookmarks = $pdfBook->bookmarks->count();
            $pdfBook->bookmarks_list = $pdfBook->bookmarks;
            $pdfBook->reading_history = $pdfBook->readingHistories->first();
        }

        // Get total number of users who favorited this book
        $pdfBook->total_favorites_count = PdfFavorite::where('pdf_book_id', $id)->count();

        // Get total number of users who bookmarked this book
        $pdfBook->total_bookmarks_count = PdfBookmark::where('pdf_book_id', $id)->count();

        // Get total number of unique readers
        $pdfBook->total_readers_count = PdfReadingHistory::where('pdf_book_id', $id)->count();

        // Add file URLs
        $pdfBook = $this->addFileUrls($pdfBook);

        // Increment view count
        $pdfBook->increment('userview');

        return $this->successResponse(
            $pdfBook,
            'PDF Book retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        // Check if user is authorized to update (uploader or admin)
        if (Auth::id() !== $pdfBook->uploaded_by && ! Auth::user()?->is_admin) {
            return $this->errorResponse('Unauthorized to update this book', null, 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'sometimes|required|exists:pdf_categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:'.self::MAX_IMAGE_SIZE,
            'file' => 'nullable|mimes:pdf|max:'.self::MAX_PDF_SIZE,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        $validated = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteFileIfExists($pdfBook->image);

            $imagePath = $request->file('image')->store('pdf-books/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('file')) {
            // Delete old file
            $this->deleteFileIfExists($pdfBook->file);

            $filePath = $request->file('file')->store('pdf-books/files', 'public');
            $validated['file'] = $filePath;
        }

        // Handle status if present
        if ($request->has('status')) {
            $validated['status'] = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
        }

        $pdfBook->update($validated);

        // Load relationships
        $pdfBook->load(['category:id,title', 'uploader:id,name']);

        // Add file URLs
        $pdfBook = $this->addFileUrls($pdfBook);

        return $this->successResponse(
            $pdfBook,
            'PDF Book updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        // Check if user is authorized to delete (uploader or admin)
        if (Auth::id() !== $pdfBook->uploaded_by && ! Auth::user()?->is_admin) {
            return $this->errorResponse('Unauthorized to delete this book', null, 403);
        }

        // Delete associated files
        $this->deleteFileIfExists($pdfBook->image);
        $this->deleteFileIfExists($pdfBook->file);

        // Related records will be deleted automatically due to cascadeOnDelete()
        $pdfBook->delete();

        return $this->successResponse(null, 'PDF Book deleted successfully');
    }

    /**
     * Download PDF file
     *
     * @param  int  $id
     * @return BinaryFileResponse|JsonResponse
     */
    public function download($id)
    {
        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        if (! $pdfBook->file) {
            return $this->errorResponse('File not found', null, 404);
        }

        $filePath = Storage::disk('public')->path($pdfBook->file);

        if (! file_exists($filePath)) {
            return $this->errorResponse('File does not exist on server', null, 404);
        }

        // Increment download count
        $pdfBook->increment('downloads');

        // Track download in reading history if user is authenticated
        if (Auth::check()) {
            $readingHistory = PdfReadingHistory::getOrCreate(Auth::id(), $id);
            $readingHistory->incrementReadCount();
        }

        $fileName = $this->sanitizeFileName($pdfBook->title).'.pdf';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    /**
     * Get all categories for dropdown
     */
    public function getCategories(): JsonResponse
    {
        $categories = PdfCategory::orderBy('title')
            ->get(['id', 'title', 'description']);

        return $this->successResponse(
            $categories,
            'Categories retrieved successfully'
        );
    }

    /**
     * Toggle book status
     *
     * @param  int  $id
     */
    public function toggleStatus($id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        // Check if user is authorized (uploader or admin)
        if (Auth::id() !== $pdfBook->uploaded_by && ! Auth::user()?->is_admin) {
            return $this->errorResponse('Unauthorized to toggle status', null, 403);
        }

        $pdfBook->status = ! $pdfBook->status;
        $pdfBook->save();

        return $this->successResponse(
            ['status' => $pdfBook->status],
            'Book status toggled successfully'
        );
    }

    /**
     * Get books by category
     *
     * @param  int  $categoryId
     */
    public function getByCategory($categoryId): JsonResponse
    {
        $category = PdfCategory::find($categoryId);

        if (! $category) {
            return $this->errorResponse('Category not found', null, 404);
        }

        $pdfBooks = PdfBook::with(['category:id,title', 'uploader:id,name'])
            ->where('category_id', $categoryId)
            ->where('status', true)
            ->withCount(['favorites', 'readingHistories'])
            ->latest()
            ->paginate(self::DEFAULT_PER_PAGE);

        // Add full URLs for files
        $pdfBooks->getCollection()->transform(function ($book) {
            return $this->addFileUrls($book);
        });

        return $this->successResponse(
            $pdfBooks,
            'Books retrieved for category: '.$category->title
        );
    }

    /**
     * Get popular books (most downloaded)
     */
    public function getPopular(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 10);

        $pdfBooks = PdfBook::with(['category:id,title', 'uploader:id,name'])
            ->where('status', true)
            ->orderBy('downloads', 'desc')
            ->limit($limit)
            ->get();

        // Add full URLs for files
        $pdfBooks->transform(function ($book) {
            return $this->addFileUrls($book);
        });

        return $this->successResponse(
            $pdfBooks,
            'Popular books retrieved successfully'
        );
    }

    /**
     * Get books uploaded by current user
     */
    public function getMyUploads(Request $request): JsonResponse
    {
        $pdfBooks = PdfBook::with(['category:id,title', 'uploader:id,name'])
            ->where('uploaded_by', Auth::id())
            ->withCount(['favorites', 'readingHistories'])
            ->orderBy('created_at', 'desc')
            ->paginate(self::DEFAULT_PER_PAGE);

        // Add full URLs for files
        $pdfBooks->getCollection()->transform(function ($book) {
            return $this->addFileUrls($book);
        });

        return $this->successResponse(
            $pdfBooks,
            'Your uploaded books retrieved successfully'
        );
    }

    /**
     * Get statistics for a book
     *
     * @param  int  $id
     */
    public function getStatistics($id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        $statistics = [
            'total_views' => $pdfBook->userview,
            'total_downloads' => $pdfBook->downloads,
            'total_favorites' => PdfFavorite::where('pdf_book_id', $id)->count(),
            'total_bookmarks' => PdfBookmark::where('pdf_book_id', $id)->count(),
            'total_readers' => PdfReadingHistory::where('pdf_book_id', $id)->count(),
            'average_reading_progress' => round(PdfReadingHistory::where('pdf_book_id', $id)->avg('reading_progress'), 2),
            'reading_history' => [
                'daily' => PdfReadingHistory::where('pdf_book_id', $id)
                    ->select(DB::raw('DATE(last_read_at) as date'), DB::raw('count(*) as count'))
                    ->groupBy('date')
                    ->orderBy('date', 'desc')
                    ->limit(30)
                    ->get(),
                'by_page' => PdfReadingHistory::where('pdf_book_id', $id)
                    ->whereNotNull('last_page')
                    ->select('last_page', DB::raw('count(*) as count'))
                    ->groupBy('last_page')
                    ->orderBy('last_page')
                    ->get(),
            ],
        ];

        return $this->successResponse(
            $statistics,
            'Book statistics retrieved successfully'
        );
    }

    /**
     * Helper method to add file URLs to book
     */
    private function addFileUrls(PdfBook $book): PdfBook
    {
        if ($book->image) {
            $book->image_url = Storage::disk('public')->url($book->image);
        }

        if ($book->file) {
            $book->file_url = Storage::disk('public')->url($book->file);
            $book->download_url = route('api.pdf-books.download', $book->id);
        }

        return $book;
    }

    /**
     * Helper method to delete file if exists
     */
    private function deleteFileIfExists(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Sanitize file name
     */
    private function sanitizeFileName(string $fileName): string
    {
        // Remove special characters and replace spaces with underscore
        $fileName = preg_replace('/[^a-zA-Z0-9\s-]/', '', $fileName);
        $fileName = str_replace(' ', '_', $fileName);

        return $fileName;
    }

    /**
     * Success response helper
     *
     * @param  mixed  $data
     */
    private function successResponse($data, string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
            'timestamp' => now()->toIso8601String(),
        ], $statusCode);
    }

    /**
     * Error response helper
     *
     * @param  mixed  $errors
     */
    private function errorResponse(string $message, $errors = null, int $statusCode = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'timestamp' => now()->toIso8601String(),
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Toggle favorite status for a book
     *
     * @param  int  $id
     */
    public function toggleFavorite($id): JsonResponse
    {
        // Check if user is authenticated
        if (! Auth::check()) {
            return $this->errorResponse('You must be logged in to favorite books', null, 401);
        }

        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        $userId = Auth::id();

        try {
            // Check if already favorited
            $favorite = PdfFavorite::where('user_id', $userId)
                ->where('pdf_book_id', $id)
                ->first();

            if ($favorite) {
                // Remove from favorites
                $favorite->delete();
                $message = 'Book removed from favorites';
                $isFavorited = false;
            } else {
                // Add to favorites
                PdfFavorite::create([
                    'user_id' => $userId,
                    'pdf_book_id' => $id,
                ]);
                $message = 'Book added to favorites';
                $isFavorited = true;
            }

            // Get updated favorite count
            $favoriteCount = PdfFavorite::where('pdf_book_id', $id)->count();

            return $this->successResponse([
                'is_favorited' => $isFavorited,
                'favorite_count' => $favoriteCount,
                'book_id' => $id,
            ], $message);

        } catch (\Exception $e) {
            \Log::error('Error toggling favorite: '.$e->getMessage());

            return $this->errorResponse(
                'Failed to toggle favorite status',
                null,
                500
            );
        }
    }

    /**
     * Get user's favorite books
     */
    public function getMyFavorites(Request $request): JsonResponse
    {
        if (! Auth::check()) {
            return $this->errorResponse('You must be logged in to view favorites', null, 401);
        }

        $userId = Auth::id();

        $validator = Validator::make($request->all(), [
            'per_page' => 'nullable|integer|min:1|max:'.self::MAX_PER_PAGE,
            'sort_field' => 'nullable|string|in:created_at,title',
            'sort_direction' => 'nullable|string|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid parameters', $validator->errors(), 422);
        }

        $perPage = $request->get('per_page', self::DEFAULT_PER_PAGE);
        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $favorites = PdfFavorite::where('user_id', $userId)
            ->with(['pdfBook' => function ($query) {
                $query->with(['category:id,title', 'uploader:id,name']);
            }])
            ->orderBy($sortField === 'title' ? 'pdfBook.title' : 'pdf_favorites.'.$sortField, $sortDirection)
            ->paginate($perPage);

        // Transform to add file URLs
        $favorites->getCollection()->transform(function ($favorite) {
            if ($favorite->pdfBook) {
                $favorite->pdfBook = $this->addFileUrls($favorite->pdfBook);
            }

            return $favorite;
        });

        return $this->successResponse(
            $favorites,
            'Favorites retrieved successfully'
        );
    }

    /**
     * Check if a book is favorited by current user
     *
     * @param  int  $id
     */
    public function checkFavorite($id): JsonResponse
    {
        if (! Auth::check()) {
            return $this->errorResponse('You must be logged in to check favorites', null, 401);
        }

        $pdfBook = PdfBook::find($id);

        if (! $pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        $isFavorited = PdfFavorite::where('user_id', Auth::id())
            ->where('pdf_book_id', $id)
            ->exists();

        $favoriteCount = PdfFavorite::where('pdf_book_id', $id)->count();

        return $this->successResponse([
            'is_favorited' => $isFavorited,
            'favorite_count' => $favoriteCount,
            'book_id' => $id,
        ], 'Favorite status retrieved successfully');
    }

    /**
     * Get favorite statistics for a user
     */
    public function getFavoriteStatistics(): JsonResponse
    {
        if (! Auth::check()) {
            return $this->errorResponse('You must be logged in to view statistics', null, 401);
        }

        $userId = Auth::id();

        $totalFavorites = PdfFavorite::where('user_id', $userId)->count();

        $recentFavorites = PdfFavorite::where('user_id', $userId)
            ->with('pdfBook:id,title,image')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $favoriteByCategory = DB::table('pdf_favorites')
            ->join('pdf_books', 'pdf_favorites.pdf_book_id', '=', 'pdf_books.id')
            ->join('pdf_categories', 'pdf_books.category_id', '=', 'pdf_categories.id')
            ->where('pdf_favorites.user_id', $userId)
            ->select('pdf_categories.title as category', DB::raw('count(*) as total'))
            ->groupBy('pdf_categories.id', 'pdf_categories.title')
            ->get();

        return $this->successResponse([
            'total_favorites' => $totalFavorites,
            'recent_favorites' => $recentFavorites,
            'favorites_by_category' => $favoriteByCategory,
        ], 'Favorite statistics retrieved successfully');
    }
}
