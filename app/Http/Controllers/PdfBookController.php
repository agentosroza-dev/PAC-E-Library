<?php

namespace App\Http\Controllers;

use App\Models\PdfBook;
use App\Models\PdfCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PdfBookController extends Controller
{
    /**
     * Maximum file sizes in KB
     */
    const MAX_IMAGE_SIZE = 2048; // 2MB
    const MAX_PDF_SIZE = 20480; // 20MB

    /**
     * Display a listing of PDF books.
     * Can search, filter and sort.
     */
    public function index(Request $request): View
    {
        try {
            // Create query for PDF books with category
            $query = PdfBook::with('category');
            $user = Auth::user();

            // Search
            if ($request->filled('search')) {
                $query->search($request->search);
            }

            // Filter by category
            if ($request->filled('category_id')) {
                $query->byCategory($request->category_id);
            }

            // Filter by status
            if ($request->filled('status')) {
                // Convert string 'active'/'inactive' or '1'/'0' to boolean
                $status = $request->status;
                if ($status === 'active' || $status === '1') {
                    $query->byStatus(true);
                } elseif ($status === 'inactive' || $status === '0') {
                    $query->byStatus(false);
                }
            }

            // Set default sort values
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');

            // Sort by selected option
            $this->applySorting($query, $sortBy, $sortOrder);

            // Set items per page (default 10)
            $perPage = $request->get('per_page', 10);
            $pdfBooks = $query->paginate($perPage)->withQueryString();

            // Get all categories for filter dropdown
            $categories = PdfCategory::orderBy('title')->get();

            // Get statistics for cards
            $statistics = PdfBook::getStatistics();

            return view('pdf-books.index', compact(
                'pdfBooks',
                'categories',
                'user',
                'statistics',
                'sortBy',
                'sortOrder'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading PDF books: ' . $e->getMessage());

            return view('pdf-books.index', [
                'pdfBooks' => collect([]),
                'categories' => PdfCategory::orderBy('title')->get(),
                'statistics' => [
                    'total_books' => 0,
                    'active_books' => 0,
                    'total_downloads' => 0,
                    'total_views' => 0,
                    'total_categories' => PdfCategory::count(),
                ],
                'sortBy' => 'created_at',
                'sortOrder' => 'desc',
                'error' => 'Failed to load PDF books. Please try again.'
            ]);
        }
    }

    /**
     * Apply sorting to query
     */
    private function applySorting($query, string $sortBy, string $sortOrder): void
    {
        switch ($sortBy) {
            case 'downloads':
            case 'userview':
            case 'title':
            case 'status':
            case 'version':
                $query->orderBy($sortBy, $sortOrder);
                break;

            case 'category':
                $query->join('pdf_categories', 'pdf_books.category_id', '=', 'pdf_categories.id')
                      ->orderBy('pdf_categories.title', $sortOrder)
                      ->select('pdf_books.*');
                break;

            default:
                $query->orderBy('created_at', $sortOrder);
                break;
        }
    }

    /**
     * Show the form for creating a new PDF book.
     */
    public function create(): View
    {
        $categories = PdfCategory::orderBy('title')->get();

        if ($categories->isEmpty()) {
            return view('pdf-books.create', compact('categories'))
                ->with('warning', 'Please create a category first before adding books.');
        }

        return view('pdf-books.create', compact('categories'));
    }

    /**
     * Store a newly created PDF book in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate input data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:pdf_categories,id',
                'status' => 'nullable|boolean',
                'version' => 'nullable|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:' . self::MAX_IMAGE_SIZE,
                'file' => 'required|mimes:pdf|max:' . self::MAX_PDF_SIZE,
            ]);

            // Handle file uploads
            $validated = $this->handleFileUploads($request, $validated);

            // Set default values
            $validated['status'] = $request->has('status') && $request->status ? true : false;
            $validated['version'] = !empty($validated['version']) ? $validated['version'] : '1.0.0';
            $validated['downloads'] = 0;
            $validated['userview'] = 0;
            $validated['uploaded_by'] = Auth::id();

            // Log for debugging
            Log::info('Creating PDF book with data:', $validated);

            // Create new PDF book
            PdfBook::create($validated);

            return redirect()
                ->route('pdf-books.index')
                ->with('success', 'PDF Book created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Delete uploaded files if validation fails
            if (isset($validated['image'])) {
                Storage::disk('public')->delete($validated['image']);
            }
            if (isset($validated['file'])) {
                Storage::disk('public')->delete($validated['file']);
            }

            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Delete uploaded files if creation fails
            if (isset($validated['image'])) {
                Storage::disk('public')->delete($validated['image']);
            }
            if (isset($validated['file'])) {
                Storage::disk('public')->delete($validated['file']);
            }

            Log::error('Error creating PDF book: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()
                ->back()
                ->with('error', 'Failed to create PDF book. Please try again.')
                ->withInput();
        }
    }

    /**
     * Handle file uploads for store and update methods
     */
    private function handleFileUploads(Request $request, array $validated, ?PdfBook $pdfBook = null): array
    {
        // Handle image upload
        if ($request->hasFile('image')) {
            // Validate image again (redundant but safe)
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:' . self::MAX_IMAGE_SIZE,
            ]);

            // Delete old image if updating
            if ($pdfBook && $pdfBook->image) {
                Storage::disk('public')->delete($pdfBook->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('pdf-books/images', 'public');

            if (!$imagePath) {
                throw new \Exception('Failed to upload image');
            }

            $validated['image'] = $imagePath;
        }

        // Handle PDF file upload
        if ($request->hasFile('file')) {
            // Validate PDF again
            $request->validate([
                'file' => 'mimes:pdf|max:' . self::MAX_PDF_SIZE,
            ]);

            // Delete old file if updating
            if ($pdfBook && $pdfBook->file) {
                Storage::disk('public')->delete($pdfBook->file);
            }

            // Store new PDF
            $filePath = $request->file('file')->store('pdf-books/files', 'public');

            if (!$filePath) {
                throw new \Exception('Failed to upload PDF file');
            }

            $validated['file'] = $filePath;
        }

        return $validated;
    }

    /**
     * Display the specified PDF book.
     * And increment user view count.
     */
    public function show(PdfBook $pdfBook): View
    {
        // Increment user view count (with session-based rate limiting)
        $pdfBook->incrementUserViewWithSession();

        // Load category relationship
        $pdfBook->load('category');

        return view('pdf-books.show', compact('pdfBook'));
    }

    /**
     * Show the form for editing the specified PDF book.
     */
    public function edit(PdfBook $pdfBook): View
    {
        $categories = PdfCategory::orderBy('title')->get();

        // if ($categories->isEmpty()) {
        //     return redirect()->route('pdf-categories.create')
        //         ->with('warning', 'Please create a category first before editing books.');
        // }

        return view('pdf-books.edit', compact('pdfBook', 'categories'));
    }

    /**
     * Update the specified PDF book in storage.
     */
    public function update(Request $request, PdfBook $pdfBook): RedirectResponse
    {
        try {
            // Validate input data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:pdf_categories,id',
                'status' => 'nullable|boolean',
                'version' => 'nullable|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:' . self::MAX_IMAGE_SIZE,
                'file' => 'nullable|mimes:pdf|max:' . self::MAX_PDF_SIZE,
            ]);

            // Handle file uploads and delete old files
            $validated = $this->handleFileUploads($request, $validated, $pdfBook);

            // Set status
            $validated['status'] = $request->has('status') && $request->status ? true : false;

            // Set version if not provided
            if (empty($validated['version'])) {
                $validated['version'] = $pdfBook->version ?? '1.0.0';
            }

            // Update book information
            $pdfBook->update($validated);

            return redirect()
                ->route('pdf-books.index')
                ->with('success', 'PDF Book updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating PDF book: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to update PDF book. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified PDF book from storage.
     */
    public function destroy(PdfBook $pdfBook): RedirectResponse
    {
        try {
            // Delete attached files
            $this->deleteBookFiles($pdfBook);

            // Delete record from database
            $pdfBook->delete();

            return redirect()
                ->route('pdf-books.index')
                ->with('success', 'PDF Book deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Error deleting PDF book: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to delete PDF book. Please try again.');
        }
    }

    /**
     * Download PDF file.
     */
    public function download(PdfBook $pdfBook)
    {
        try {
            // Check if file exists in database
            if (!$pdfBook->file) {
                return redirect()
                    ->back()
                    ->with('error', 'File not found in database!');
            }

            // Get file path
            $filePath = Storage::disk('public')->path($pdfBook->file);

            // Check if file exists in storage
            if (!file_exists($filePath)) {
                Log::error('File not found in storage: ' . $pdfBook->file);
                return redirect()
                    ->back()
                    ->with('error', 'File does not exist in storage!');
            }

            // Increment download count
            $pdfBook->incrementDownloads();

            // Generate safe filename
            $fileName = $this->sanitizeFileName($pdfBook->title) . '.pdf';

            // Download file
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
            ]);

        } catch (\Exception $e) {
            Log::error('Error downloading PDF book: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to download file. Please try again.');
        }
    }

    /**
     * Delete book files from storage
     */
    private function deleteBookFiles(PdfBook $pdfBook): void
    {
        $defaultFiles = ['default.png', 'sample.pdf'];

        if ($pdfBook->image && !in_array(basename($pdfBook->image), $defaultFiles)) {
            Storage::disk('public')->delete($pdfBook->image);
        }

        if ($pdfBook->file && !in_array(basename($pdfBook->file), $defaultFiles)) {
            Storage::disk('public')->delete($pdfBook->file);
        }
    }

    /**
     * Sanitize file name for download
     */
    private function sanitizeFileName(string $title): string
    {
        // Remove special characters and replace spaces with underscore
        $fileName = preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $title);
        $fileName = preg_replace('/\s+/', '_', $fileName);
        return $fileName ?: 'book';
    }

    /**
     * Display list of most downloaded books.
     */
    public function mostDownloaded(): View
    {
        $mostDownloaded = PdfBook::with('category')
            ->orderBy('downloads', 'desc')
            ->limit(10)
            ->get();

        return view('pdf-books.most-downloaded', compact('mostDownloaded'));
    }

    /**
     * Display list of most viewed books.
     */
    public function mostViewed(): View
    {
        $mostViewed = PdfBook::with('category')
            ->orderBy('userview', 'desc')
            ->limit(10)
            ->get();

        return view('pdf-books.most-viewed', compact('mostViewed'));
    }

    /**
     * Reset download count (admin only).
     */
    public function resetDownloads(PdfBook $pdfBook): RedirectResponse
    {
        try {
            $pdfBook->update(['downloads' => 0]);

            return redirect()
                ->back()
                ->with('success', 'Download count reset successfully!');

        } catch (\Exception $e) {
            Log::error('Error resetting download count: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to reset download count.');
        }
    }

    /**
     * Reset user view count (admin only).
     */
    public function resetUserViews(PdfBook $pdfBook): RedirectResponse
    {
        try {
            $pdfBook->update(['userview' => 0]);

            return redirect()
                ->back()
                ->with('success', 'User view count reset successfully!');

        } catch (\Exception $e) {
            Log::error('Error resetting view count: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Failed to reset view count.');
        }
    }
}
