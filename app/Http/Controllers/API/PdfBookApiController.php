<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PdfBook;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
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
     * Constructor with middleware
     */

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'search' => 'nullable|string|max:100',
            'sort_field' => 'nullable|string|in:title,created_at,updated_at,version',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'per_page' => 'nullable|integer|min:1|max:' . self::MAX_PER_PAGE,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid parameters', $validator->errors(), 422);
        }

        $query = PdfBook::with('category:id,title');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
            $query->where('status', $status);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Search by title or description
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', self::DEFAULT_PER_PAGE);
        $pdfBooks = $query->paginate($perPage);

        // Add full URLs for files
        $pdfBooks->getCollection()->transform(function ($book) {
            return $this->addFileUrls($book);
        });

        return $this->successResponse(
            $pdfBooks,
            'PDF Books retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Authorization check


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:' . self::MAX_IMAGE_SIZE,
            'file' => 'required|mimes:pdf|max:' . self::MAX_PDF_SIZE,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        $validated = $validator->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pdf-books/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pdf-books/files', 'public');
            $validated['file'] = $filePath;
        }

        // Set default status if not provided
        $validated['status'] = $request->has('status')
            ? filter_var($request->status, FILTER_VALIDATE_BOOLEAN)
            : false;

        // Set default version if not provided
        if (!isset($validated['version']) || empty($validated['version'])) {
            $validated['version'] = '1.0.0';
        }

        $pdfBook = PdfBook::create($validated);

        // Load category relationship
        $pdfBook->load('category:id,title');

        // Add file URLs
        $pdfBook = $this->addFileUrls($pdfBook);

        return $this->successResponse(
            $pdfBook,
            'PDF Book created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $pdfBook = PdfBook::with('category:id,title')->find($id);

        if (!$pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        // Add file URLs
        $pdfBook = $this->addFileUrls($pdfBook);

        return $this->successResponse(
            $pdfBook,
            'PDF Book retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (!$pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }


        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:' . self::MAX_IMAGE_SIZE,
            'file' => 'nullable|mimes:pdf|max:' . self::MAX_PDF_SIZE,
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

        // Load category relationship
        $pdfBook->load('category:id,title');

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
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (!$pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }


        // Delete associated files
        $this->deleteFileIfExists($pdfBook->image);
        $this->deleteFileIfExists($pdfBook->file);

        $pdfBook->delete();

        return $this->successResponse(null, 'PDF Book deleted successfully');
    }

    /**
     * Download PDF file
     *
     * @param int $id
     * @return BinaryFileResponse|JsonResponse
     */
    public function download($id)
    {
        $pdfBook = PdfBook::find($id);

        if (!$pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }

        if (!$pdfBook->file) {
            return $this->errorResponse('File not found', null, 404);
        }

        $filePath = Storage::disk('public')->path($pdfBook->file);

        if (!file_exists($filePath)) {
            return $this->errorResponse('File does not exist on server', null, 404);
        }

        // Increment download count if you have such field
        // $pdfBook->increment('download_count');

        $fileName = $this->sanitizeFileName($pdfBook->title) . '.pdf';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }

    /**
     * Get all categories for dropdown
     *
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = Category::orderBy('title')
            ->get(['id', 'title', 'description']);

        return $this->successResponse(
            $categories,
            'Categories retrieved successfully'
        );
    }

    /**
     * Toggle book status
     *
     * @param int $id
     * @return JsonResponse
     */
    public function toggleStatus($id): JsonResponse
    {
        $pdfBook = PdfBook::find($id);

        if (!$pdfBook) {
            return $this->errorResponse('PDF Book not found', null, 404);
        }


        $pdfBook->status = !$pdfBook->status;
        $pdfBook->save();

        return $this->successResponse(
            ['status' => $pdfBook->status],
            'Book status toggled successfully'
        );
    }

    /**
     * Get books by category
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function getByCategory($categoryId): JsonResponse
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return $this->errorResponse('Category not found', null, 404);
        }

        $pdfBooks = PdfBook::with('category:id,title')
            ->where('category_id', $categoryId)
            ->where('status', true)
            ->latest()
            ->paginate(self::DEFAULT_PER_PAGE);

        // Add full URLs for files
        $pdfBooks->getCollection()->transform(function ($book) {
            return $this->addFileUrls($book);
        });

        return $this->successResponse(
            $pdfBooks,
            'Books retrieved for category: ' . $category->title
        );
    }

    /**
     * Helper method to add file URLs to book
     *
     * @param PdfBook $book
     * @return PdfBook
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
     *
     * @param string|null $filePath
     * @return void
     */
    private function deleteFileIfExists(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Sanitize file name
     *
     * @param string $fileName
     * @return string
     */
    private function sanitizeFileName(string $fileName): string
    {
        // Remove special characters and replace spaces with underscore
        $fileName = preg_replace('/[^a-zA-Z0-9\s]/', '', $fileName);
        $fileName = str_replace(' ', '_', $fileName);
        return $fileName;
    }

    /**
     * Success response helper
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
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
     * @param string $message
     * @param mixed $errors
     * @param int $statusCode
     * @return JsonResponse
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
}
