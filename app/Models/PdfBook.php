<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfBook extends Model
{
    /** @use HasFactory<\Database\Factories\PdfBookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'status',
        'version',
        'image',
        'file',
        'downloads',
        'userview' // បន្ថែម userview ទៅក្នុង fillable
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'downloads' => 'integer',
        'userview' => 'integer', // បន្ថែម cast សម្រាប់ userview
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category that owns the pdf book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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

        if (cache()->has($cacheKey)) {
            \Log::warning('Duplicate download attempt prevented', [
                'book_id' => $this->id,
                'ip' => $ip
            ]);
            return false;
        }

        // Set cache for 6 seconds
        cache()->put($cacheKey, true, now()->addSeconds($seconds));

        return $this->increment('downloads');
    }

    /**
     * Increment user view count.
     *
     * @return bool
     */
public function incrementUserView($seconds = 3)
{
    $ip = request()->ip();
    $cacheKey = "view_{$this->id}_{$ip}";

    if (cache()->has($cacheKey)) {
        \Log::info('Duplicate view attempt prevented', [
            'book_id' => $this->id,
            'title' => $this->title,
            'ip' => $ip,
            'timestamp' => now()->toDateTimeString()
        ]);
        return false;
    }

    // Set cache for specified seconds
    cache()->put($cacheKey, true, now()->addSeconds($seconds));

    return $this->increment('userview');
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

        return $this->increment('userview');
    }

    /**
     * Increment user view with IP-based rate limiting.
     *
     * @return bool
     */
    public function incrementUserViewWithIp()
    {
        $ip = request()->ip();
        $cacheKey = "view_{$this->id}_{$ip}";

        if (cache()->has($cacheKey)) {
            return false;
        }

        // Set cache for 1 hour (3600 seconds)
        cache()->put($cacheKey, true, now()->addHours(1));

        return $this->increment('userview');
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
     * Get the total number of books with file.
     *
     * @return int
     */
    public static function getTotalBooksWithFile()
    {
        return self::whereNotNull('file')->count();
    }

    /**
     * Get the total number of books without file.
     *
     * @return int
     */
    public static function getTotalBooksWithoutFile()
    {
        return self::whereNull('file')->count();
    }

    /**
     * Get the total number of books with image.
     *
     * @return int
     */
    public static function getTotalBooksWithImage()
    {
        return self::whereNotNull('image')->count();
    }

    /**
     * Get the total number of books by category.
     *
     * @param int $categoryId
     * @return int
     */
    public static function getTotalBooksByCategory($categoryId)
    {
        return self::where('category_id', $categoryId)->count();
    }

    /**
     * Get the total number of books grouped by category.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getTotalBooksGroupedByCategory()
    {
        return self::selectRaw('category_id, count(*) as total')
            ->with('category')
            ->groupBy('category_id')
            ->get();
    }

    /**
     * Get the total number of downloads.
     *
     * @return int
     */
    public static function getTotalDownloads()
    {
        return self::sum('downloads');
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
            'books_with_file' => self::whereNotNull('file')->count(),
            'books_without_file' => self::whereNull('file')->count(),
            'books_with_image' => self::whereNotNull('image')->count(),
            'books_without_image' => self::whereNull('image')->count(),
            'categories_count' => Category::count(),
            'total_downloads' => self::getTotalDownloads(),
            'total_views' => self::getTotalUserViews(), // បន្ថែម total views
            'most_downloaded' => self::mostDownloaded()->get(),
            'most_viewed' => self::mostViewed()->get(), // បន្ថែម most viewed
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
     * Get the file extension.
     *
     * @return string|null
     */
    public function getFileExtensionAttribute()
    {
        if (!$this->file) {
            return null;
        }

        return strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
    }

    /**
     * Check if the file is a PDF.
     *
     * @return bool
     */
    public function getIsPdfAttribute()
    {
        return $this->file_extension === 'pdf';
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

    /**
     * Check if book has been downloaded.
     *
     * @return bool
     */
    public function getHasDownloadsAttribute()
    {
        return ($this->downloads ?? 0) > 0;
    }

    /**
     * Check if book has been viewed.
     *
     * @return bool
     */
    public function getHasViewsAttribute()
    {
        return ($this->userview ?? 0) > 0;
    }
}
