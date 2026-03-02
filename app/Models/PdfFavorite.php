<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfFavorite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pdf_favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pdf_book_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the favorite.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the PDF book that is favorited.
     */
    public function pdfBook(): BelongsTo
    {
        return $this->belongsTo(PdfBook::class, 'pdf_book_id');
    }

    /**
     * Scope a query to get favorites for a specific user.
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
     * Scope a query to get favorites for a specific book.
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
     * Scope a query to get favorites created within a date range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBetween($query, string $startDate, string $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Check if a user has favorited a specific book.
     *
     * @param int $userId
     * @param int $bookId
     * @return bool
     */
    public static function isFavorited(int $userId, int $bookId): bool
    {
        return self::where('user_id', $userId)
            ->where('pdf_book_id', $bookId)
            ->exists();
    }

    /**
     * Toggle favorite status for a user and book.
     *
     * @param int $userId
     * @param int $bookId
     * @return array ['favorited' => bool, 'action' => 'added|removed']
     */
    public static function toggle(int $userId, int $bookId): array
    {
        $favorite = self::where('user_id', $userId)
            ->where('pdf_book_id', $bookId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return [
                'favorited' => false,
                'action' => 'removed'
            ];
        }

        self::create([
            'user_id' => $userId,
            'pdf_book_id' => $bookId
        ]);

        return [
            'favorited' => true,
            'action' => 'added'
        ];
    }
}
