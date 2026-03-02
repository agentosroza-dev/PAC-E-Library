<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfBookmark extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pdf_bookmarks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pdf_book_id',
        'page_number',
        'note',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'page_number' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the bookmark.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the PDF book that is bookmarked.
     */
    public function pdfBook(): BelongsTo
    {
        return $this->belongsTo(PdfBook::class, 'pdf_book_id');
    }

    /**
     * Scope a query to get bookmarks for a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to get bookmarks for a specific book.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $bookId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForBook($query, int $bookId)
    {
        return $query->where('pdf_book_id', $bookId);
    }

    /**
     * Scope a query to get bookmarks on a specific page.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $pageNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnPage($query, int $pageNumber)
    {
        return $query->where('page_number', $pageNumber);
    }

    /**
     * Scope a query to get bookmarks with notes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithNotes($query)
    {
        return $query->whereNotNull('note')->where('note', '!=', '');
    }

    /**
     * Get bookmarks grouped by page number for a specific user and book.
     *
     * @param int $userId
     * @param int $bookId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getForUserAndBook(int $userId, int $bookId)
    {
        return self::where('user_id', $userId)
            ->where('pdf_book_id', $bookId)
            ->orderBy('page_number')
            ->get();
    }

    /**
     * Check if a user has bookmarked a specific page.
     *
     * @param int $userId
     * @param int $bookId
     * @param int $pageNumber
     * @return bool
     */
    public static function isPageBookmarked(int $userId, int $bookId, int $pageNumber): bool
    {
        return self::where('user_id', $userId)
            ->where('pdf_book_id', $bookId)
            ->where('page_number', $pageNumber)
            ->exists();
    }

    /**
     * Toggle bookmark for a specific page.
     *
     * @param int $userId
     * @param int $bookId
     * @param int $pageNumber
     * @param string|null $note
     * @return array ['bookmarked' => bool, 'action' => 'added|removed', 'bookmark' => object|null]
     */
    public static function togglePage(int $userId, int $bookId, int $pageNumber, ?string $note = null): array
    {
        $bookmark = self::where('user_id', $userId)
            ->where('pdf_book_id', $bookId)
            ->where('page_number', $pageNumber)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return [
                'bookmarked' => false,
                'action' => 'removed',
                'bookmark' => null
            ];
        }

        $bookmark = self::create([
            'user_id' => $userId,
            'pdf_book_id' => $bookId,
            'page_number' => $pageNumber,
            'note' => $note
        ]);

        return [
            'bookmarked' => true,
            'action' => 'added',
            'bookmark' => $bookmark
        ];
    }

    /**
     * Get the next page number that has a bookmark.
     *
     * @param int $currentPage
     * @return int|null
     */
    public function getNextBookmarkedPage(int $currentPage): ?int
    {
        $next = self::where('user_id', $this->user_id)
            ->where('pdf_book_id', $this->pdf_book_id)
            ->where('page_number', '>', $currentPage)
            ->orderBy('page_number', 'asc')
            ->first();

        return $next ? $next->page_number : null;
    }

    /**
     * Get the previous page number that has a bookmark.
     *
     * @param int $currentPage
     * @return int|null
     */
    public function getPreviousBookmarkedPage(int $currentPage): ?int
    {
        $previous = self::where('user_id', $this->user_id)
            ->where('pdf_book_id', $this->pdf_book_id)
            ->where('page_number', '<', $currentPage)
            ->orderBy('page_number', 'desc')
            ->first();

        return $previous ? $previous->page_number : null;
    }
}
