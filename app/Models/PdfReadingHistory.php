<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfReadingHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pdf_reading_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pdf_book_id',
        'last_read_at',
        'read_count',
        'last_page',
        'reading_progress',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_read_at' => 'datetime',
        'read_count' => 'integer',
        'last_page' => 'integer',
        'reading_progress' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'last_read_at',
    ];

    /**
     * Get the user that owns the reading history.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the PDF book that was read.
     */
    public function pdfBook(): BelongsTo
    {
        return $this->belongsTo(PdfBook::class, 'pdf_book_id');
    }

    /**
     * Scope a query to get reading history for a specific user.
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
     * Scope a query to get reading history for a specific book.
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
     * Scope a query to get recently read books.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentlyRead($query, int $limit = 10)
    {
        return $query->orderBy('last_read_at', 'desc')->limit($limit);
    }

    /**
     * Scope a query to get most read books.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMostRead($query, int $limit = 10)
    {
        return $query->orderBy('read_count', 'desc')->limit($limit);
    }

    /**
     * Scope a query to get books with reading progress.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $minProgress
     * @param int $maxProgress
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProgressBetween($query, int $minProgress = 0, int $maxProgress = 100)
    {
        return $query->whereBetween('reading_progress', [$minProgress, $maxProgress]);
    }

    /**
     * Get or create reading history for a user and book.
     *
     * @param int $userId
     * @param int $bookId
     * @return self
     */
    public static function getOrCreate(int $userId, int $bookId): self
    {
        return self::firstOrCreate(
            [
                'user_id' => $userId,
                'pdf_book_id' => $bookId
            ],
            [
                'last_read_at' => now(),
                'read_count' => 0,
                'last_page' => 1,
                'reading_progress' => 0
            ]
        );
    }

    /**
     * Update reading progress.
     *
     * @param int $pageNumber
     * @param int|null $totalPages
     * @return $this
     */
    public function updateProgress(int $pageNumber, ?int $totalPages = null)
    {
        $this->last_page = $pageNumber;

        if ($totalPages && $totalPages > 0) {
            $progress = round(($pageNumber / $totalPages) * 100);
            $this->reading_progress = min($progress, 100);
        }

        $this->last_read_at = now();
        $this->save();

        return $this;
    }

    /**
     * Increment read count.
     *
     * @return $this
     */
    public function incrementReadCount()
    {
        $this->increment('read_count');
        $this->last_read_at = now();
        $this->save();

        return $this;
    }

    /**
     * Check if the book is completed (100% read).
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->reading_progress >= 100;
    }

    /**
     * Get time since last read.
     *
     * @return string
     */
    public function getTimeSinceLastRead(): string
    {
        return $this->last_read_at->diffForHumans();
    }

    /**
     * Get reading statistics for a user.
     *
     * @param int $userId
     * @return array
     */
    public static function getUserStatistics(int $userId): array
    {
        $histories = self::where('user_id', $userId)->get();

        $totalBooks = $histories->count();
        $totalReads = $histories->sum('read_count');
        $completedBooks = $histories->where('reading_progress', 100)->count();
        $inProgressBooks = $histories->where('reading_progress', '<', 100)->where('reading_progress', '>', 0)->count();
        $notStartedBooks = $histories->where('reading_progress', 0)->count();

        $averageProgress = $histories->avg('reading_progress') ?? 0;

        $mostReadBook = $histories->sortByDesc('read_count')->first();
        $lastReadBook = $histories->sortByDesc('last_read_at')->first();

        // Reading streak (consecutive days with reading activity)
        $readingDays = $histories->pluck('last_read_at')
            ->map(fn($date) => $date->format('Y-m-d'))
            ->unique()
            ->sort()
            ->values();

        $streak = 0;
        $currentDate = now();

        for ($i = 0; $i < $readingDays->count(); $i++) {
            if ($readingDays[$i] == $currentDate->copy()->subDays($i)->format('Y-m-d')) {
                $streak++;
            } else {
                break;
            }
        }

        return [
            'total_books' => $totalBooks,
            'total_reads' => $totalReads,
            'completed_books' => $completedBooks,
            'in_progress_books' => $inProgressBooks,
            'not_started_books' => $notStartedBooks,
            'average_progress' => round($averageProgress, 2),
            'current_streak' => $streak,
            'most_read_book' => $mostReadBook ? [
                'id' => $mostReadBook->pdf_book_id,
                'title' => $mostReadBook->pdfBook->title ?? 'Unknown',
                'read_count' => $mostReadBook->read_count
            ] : null,
            'last_read_book' => $lastReadBook ? [
                'id' => $lastReadBook->pdf_book_id,
                'title' => $lastReadBook->pdfBook->title ?? 'Unknown',
                'last_read_at' => $lastReadBook->last_read_at
            ] : null,
        ];
    }

    /**
     * Get reading history with book details for a user.
     *
     * @param int $userId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getUserHistoryWithBooks(int $userId, int $perPage = 15)
    {
        return self::with(['pdfBook' => function($query) {
                $query->select('id', 'title', 'image', 'file', 'category_id', 'uploaded_by')
                    ->with(['category:id,title', 'uploader:id,name']);
            }])
            ->where('user_id', $userId)
            ->orderBy('last_read_at', 'desc')
            ->paginate($perPage);
    }
}
