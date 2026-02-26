<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PdfBook extends Model
{
    /** @use HasFactory<\Database\Factories\PdfBookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'uploaded_by', // Added missing field
        'status',
        'version',
        'image',
        'file',
        'downloads',
        'userview'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'downloads' => 'integer',
        'userview' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category that owns the pdf book.
     */
    public function category()
    {
        return $this->belongsTo(PdfCategory::class, 'category_id', 'id'); // FIXED: Correct foreign key
    }

    /**
     * Get the user who uploaded the book.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }

    /**
     * Scope a query to only include active books.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include inactive books.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    /**
     * Scope a query to search books by title or description.
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function($q) use ($term) {
                $q->where('title', 'LIKE', "%{$term}%")
                  ->orWhere('description', 'LIKE', "%{$term}%");
            });
        }
        return $query;
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, $status)
    {
        if ($status !== null) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope a query to get most downloaded books.
     */
    public function scopeMostDownloaded($query, $limit = 5)
    {
        return $query->orderBy('downloads', 'desc')->limit($limit);
    }

    /**
     * Scope a query to get most viewed books.
     */
    public function scopeMostViewed($query, $limit = 5)
    {
        return $query->orderBy('userview', 'desc')->limit($limit);
    }

    /**
     * Increment download count with rate limiting.
     *
     * @return bool
     */
    public function incrementDownloads($seconds = 3)
    {
        $ip = request()->ip();
        $cacheKey = "download_{$this->id}_{$ip}";

        if (Cache::has($cacheKey)) {
            \Log::warning('Duplicate download attempt prevented', [
                'book_id' => $this->id,
                'ip' => $ip
            ]);
            return false;
        }

        Cache::put($cacheKey, true, now()->addSeconds($seconds));

        $this->increment('downloads');
        return true;
    }

    /**
     * Increment user view count with rate limiting.
     *
     * @return bool
     */
    public function incrementUserView($seconds = 3)
    {
        $ip = request()->ip();
        $cacheKey = "view_{$this->id}_{$ip}";

        if (Cache::has($cacheKey)) {
            \Log::info('Duplicate view attempt prevented', [
                'book_id' => $this->id,
                'title' => $this->title,
                'ip' => $ip,
                'timestamp' => now()->toDateTimeString()
            ]);
            return false;
        }

        Cache::put($cacheKey, true, now()->addSeconds($seconds));

        $this->increment('userview');
        return true;
    }

    /**
     * Increment user view with session-based rate limiting.
     *
     * @return bool
     */
    public function incrementUserViewWithSession()
    {
        $sessionKey = 'viewed_book_' . $this->id;

        if (session()->has($sessionKey)) {
            return false;
        }

        session()->put($sessionKey, true);
        $this->increment('userview');
        return true;
    }

    /**
     * Get the total number of user views.
     *
     * @return int
     */
    public static function getTotalUserViews()
    {
        return self::sum('userview');
    }

    /**
     * Get the total number of books.
     *
     * @return int
     */
    public static function getTotalBooks()
    {
        return self::count();
    }

    /**
     * Get the total number of active books.
     *
     * @return int
     */
    public static function getTotalActiveBooks()
    {
        return self::where('status', true)->count();
    }

    /**
     * Get the total number of inactive books.
     *
     * @return int
     */
    public static function getTotalInactiveBooks()
    {
        return self::where('status', false)->count();
    }

    /**
     * Get statistics for dashboard.
     *
     * @return array
     */
    public static function getStatistics()
    {
        return [
            'total_books' => self::count(),
            'active_books' => self::where('status', true)->count(),
            'inactive_books' => self::where('status', false)->count(),
            'categories_count' => PdfCategory::count(),
            'total_downloads' => self::sum('downloads'),
            'total_views' => self::sum('userview'),
            'most_downloaded' => self::with('category')->mostDownloaded(5)->get(),
            'most_viewed' => self::with('category')->mostViewed(5)->get(),
        ];
    }

    /**
     * Get the file size in a human-readable format.
     *
     * @return string|null
     */
    public function getFileSizeAttribute()
    {
        if (!$this->file) {
            return null;
        }

        $path = storage_path('app/public/' . $this->file);
        if (!file_exists($path)) {
            return null;
        }

        $bytes = filesize($path);
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get the image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get the file URL.
     *
     * @return string|null
     */
    public function getFileUrlAttribute()
    {
        if (!$this->file) {
            return null;
        }

        return asset('storage/' . $this->file);
    }

    /**
     * Get formatted downloads number.
     *
     * @return string
     */
    public function getFormattedDownloadsAttribute()
    {
        $downloads = $this->downloads ?? 0;

        if ($downloads >= 1000000) {
            return round($downloads / 1000000, 1) . 'M';
        } elseif ($downloads >= 1000) {
            return round($downloads / 1000, 1) . 'K';
        }

        return (string) $downloads;
    }

    /**
     * Get formatted user views number.
     *
     * @return string
     */
    public function getFormattedUserViewsAttribute()
    {
        $views = $this->userview ?? 0;

        if ($views >= 1000000) {
            return round($views / 1000000, 1) . 'M';
        } elseif ($views >= 1000) {
            return round($views / 1000, 1) . 'K';
        }

        return (string) $views;
    }
}
