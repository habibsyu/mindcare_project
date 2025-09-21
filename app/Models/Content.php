<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'body',
        'video_url',
        'video_thumbnail',
        'thumbnail',
        'quiz_data',
        'category',
        'tags',
        'reading_time',
        'views',
        'likes',
        'featured',
        'published',
        'seo_meta',
        'created_by',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'quiz_data' => 'array',
            'tags' => 'array',
            'seo_meta' => 'array',
            'featured' => 'boolean',
            'published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($content) {
            if (empty($content->slug)) {
                $content->slug = \Str::slug($content->title);
            }
            
            // Auto-calculate reading time for articles
            if ($content->type === 'article' && $content->body) {
                $wordCount = str_word_count(strip_tags($content->body));
                $content->reading_time = max(1, ceil($wordCount / 200)); // 200 words per minute
            }
        });
    }

    /**
     * Get the author
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get content interactions
     */
    public function interactions()
    {
        return $this->hasMany(ContentInteraction::class);
    }

    /**
     * Get quiz attempts
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Scope for published content
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured content
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    /**
     * Scope by type
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope by category
     */
    public function scopeInCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Increment views
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get YouTube video ID from URL
     */
    public function getYoutubeVideoIdAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
        
        return $matches[1] ?? null;
    }

    /**
     * Get YouTube thumbnail URL
     */
    public function getYoutubeThumbnailAttribute(): ?string
    {
        $videoId = $this->youtube_video_id;
        
        if (!$videoId) {
            return null;
        }

        return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
    }
}