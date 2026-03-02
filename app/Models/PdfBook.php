<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PdfBook extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'image',
        'file',
        'downloads',
        'userview',
        'version',
        'category_id',
        'uploaded_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'downloads' => 'integer',
        'userview' => 'integer',
    ];

    /**
     * Get the category that owns the book
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PdfCategory::class, 'category_id');
    }

    /**
     * Get the user who uploaded the book
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the favorites for the book
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(PdfFavorite::class, 'pdf_book_id');
    }

    /**
     * Get the bookmarks for the book
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(PdfBookmark::class, 'pdf_book_id');
    }

    /**
     * Get the reading histories for the book
     */
    public function readingHistories(): HasMany
    {
        return $this->hasMany(PdfReadingHistory::class, 'pdf_book_id');
    }

    /**
     * Scope a query to search by title or description
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to filter by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Increment user view with session-based rate limiting
     */
    public function incrementUserViewWithSession()
    {
        $sessionKey = 'viewed_book_' . $this->id;

        if (!session()->has($sessionKey)) {
            $this->increment('userview');
            session()->put($sessionKey, true);
        }
    }

    /**
     * Increment download count
     */
    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    /**
     * Get statistics for all books (static method)
     */
    public static function getStatistics(): array
    {
        return [
            'total_books' => self::count(),
            'active_books' => self::where('status', true)->count(),
            'total_downloads' => self::sum('downloads'),
            'total_views' => self::sum('userview'),
            'total_categories' => PdfCategory::count(),
        ];
    }
}
