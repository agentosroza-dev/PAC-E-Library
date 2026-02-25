<?php

namespace App\Http\Controllers;

use App\Models\PdfBook;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PdfBookController extends Controller
{
    /**
     * Display a listing of PDF books.
     * Can search, filter and sort.
     */
    public function index(Request $request)
    {
        // Create query for PDF books with category
        $query = PdfBook::with('category');

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->byCategory($request->category_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->byStatus($request->status);
        }

        // Set default sort values
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Sort by selected option
        if ($sortBy == 'downloads') {
            $query->orderBy('downloads', $sortOrder);
        } elseif ($sortBy == 'userview') {
            $query->orderBy('userview', $sortOrder);
        } elseif ($sortBy == 'title') {
            $query->orderBy('title', $sortOrder);
        } elseif ($sortBy == 'category_id') {
            $query->join('categories', 'pdf_books.category_id', '=', 'categories.id')
                  ->orderBy('categories.title', $sortOrder)
                  ->select('pdf_books.*');
        } elseif ($sortBy == 'status') {
            $query->orderBy('status', $sortOrder);
        } elseif ($sortBy == 'version') {
            $query->orderBy('version', $sortOrder);
        } else {
            $query->orderBy('created_at', $sortOrder);
        }

        // Set items per page (default 10)
        $perPage = $request->get('per_page', 10);
        $pdfBooks = $query->paginate($perPage)->withQueryString();

        // Get all categories for filter dropdown
        $categories = Category::orderBy('title')->get();

        // Get statistics for cards
        $statistics = PdfBook::getStatistics();

        // Pass data to view
        return view('pdf-books.index', compact(
            'pdfBooks',
            'categories',
            'statistics',
            'sortBy',
            'sortOrder'
        ));
    }

    /**
     * Show the form for creating a new PDF book.
     */
    public function create(): View
    {
        // Get all categories for dropdown
        $categories = Category::orderBy('title')->get();
        return view('pdf-books.create', compact('categories'));
    }

    /**
     * Store a newly created PDF book in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);

        // Save image if exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pdf-books/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Save PDF file if exists
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pdf-books/files', 'public');
            $validated['file'] = $filePath;
        }

        // Set default status if not selected
        $validated['status'] = $request->has('status') ? true : false;

        // Set default version if not provided
        if (!isset($validated['version']) || empty($validated['version'])) {
            $validated['version'] = '1.0.0';
        }

        // Initialize download count to 0
        $validated['downloads'] = 0;

        // Initialize user view count to 0
        $validated['userview'] = 0;

        // Create new PDF book
        PdfBook::create($validated);

        // Redirect to index page with success message
        return redirect()
            ->route('pdf-books.index')
            ->with('success', 'PDF Book created successfully!');
    }

    /**
     * Display the specified PDF book.
     * And increment user view count.
     */
    public function show(PdfBook $pdfBook): View
    {
        // Increment user view count (using session-based rate limiting)
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
        // Get all categories for dropdown
        $categories = Category::orderBy('title')->get();
        return view('pdf-books.edit', compact('pdfBook', 'categories'));
    }

    /**
     * Update the specified PDF book in storage.
     */
    public function update(Request $request, PdfBook $pdfBook): RedirectResponse
    {
        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'version' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
        ]);

        // Save new image if changed
        if ($request->hasFile('image')) {
            // Delete old image
            if ($pdfBook->image) {
                Storage::disk('public')->delete($pdfBook->image);
            }
            $imagePath = $request->file('image')->store('pdf-books/images', 'public');
            $validated['image'] = $imagePath;
        }

        // Save new PDF file if changed
        if ($request->hasFile('file')) {
            // Delete old file
            if ($pdfBook->file) {
                Storage::disk('public')->delete($pdfBook->file);
            }
            $filePath = $request->file('file')->store('pdf-books/files', 'public');
            $validated['file'] = $filePath;
        }

        // Set status
        $validated['status'] = $request->has('status') ? true : false;

        // Set version if not provided
        if (!isset($validated['version']) || empty($validated['version'])) {
            $validated['version'] = $pdfBook->version ?? '1.0.0';
        }

        // Keep download count and user view count unchanged

        // Update book information
        $pdfBook->update($validated);

        // Redirect to index page with success message
        return redirect()
            ->route('pdf-books.index')
            ->with('success', 'PDF Book updated successfully!');
    }

    /**
     * Remove the specified PDF book from storage.
     */
    public function destroy(PdfBook $pdfBook): RedirectResponse
    {
        // Delete attached files (image and PDF file)
        if ($pdfBook->image && $pdfBook->image !== 'default.png') {
            Storage::disk('public')->delete($pdfBook->image);
        }
        if ($pdfBook->file && $pdfBook->file !== 'sample.pdf') {
            Storage::disk('public')->delete($pdfBook->file);
        }

        // Delete record from database
        $pdfBook->delete();

        // Redirect to index page with success message
        return redirect()
            ->route('pdf-books.index')
            ->with('success', 'PDF Book deleted successfully!');
    }

    /**
     * Download PDF file.
     */
    public function download(PdfBook $pdfBook)
    {
        // Check if file exists
        if (!$pdfBook->file) {
            return redirect()
                ->back()
                ->with('error', 'File not found!');
        }

        // Get file path
        $filePath = storage_path('app/public/' . $pdfBook->file);

        // Check if file exists in storage
        if (!file_exists($filePath)) {
            return redirect()
                ->back()
                ->with('error', 'File does not exist in storage!');
        }

        // Increment download count
        $pdfBook->incrementDownloads();

        // Download file
        return response()->download($filePath, $pdfBook->title . '.pdf');
    }

    /**
     * Display list of most downloaded books.
     */
    public function mostDownloaded()
    {
        // Get top 10 most downloaded books
        $mostDownloaded = PdfBook::with('category')
            ->orderBy('downloads', 'desc')
            ->limit(10)
            ->get();

        return view('pdf-books.most-downloaded', compact('mostDownloaded'));
    }

    /**
     * Display list of most viewed books.
     */
    public function mostViewed()
    {
        // Get top 10 most viewed books
        $mostViewed = PdfBook::with('category')
            ->orderBy('userview', 'desc')
            ->limit(10)
            ->get();

        return view('pdf-books.most-viewed', compact('mostViewed'));
    }

    /**
     * Reset download count (admin only).
     */
    public function resetDownloads(PdfBook $pdfBook)
    {
        // Reset download count to 0
        $pdfBook->update(['downloads' => 0]);

        return redirect()
            ->back()
            ->with('success', 'Download count reset successfully!');
    }

    /**
     * Reset user view count (admin only).
     */
    public function resetUserViews(PdfBook $pdfBook)
    {
        // Reset user view count to 0
        $pdfBook->update(['userview' => 0]);

        return redirect()
            ->back()
            ->with('success', 'User view count reset successfully!');
    }
}
