<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'category',
        'tags',
        'seo_meta',
        'views',
        'reading_time',
        'featured',
        'published',
        'author_id',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
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
        
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = \Str::slug($blog->title);
            }
            
            // Auto-calculate reading time
            if ($blog->body) {
                $wordCount = str_word_count(strip_tags($blog->body));
                $blog->reading_time = max(1, ceil($wordCount / 200)); // 200 words per minute
            }
        });
    }

    /**
     * Get the author
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope for published blogs
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured blogs
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    /**
     * Scope by category
     */
    public function scopeInCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope by tag
     */
    public function scopeWithTag(Builder $query, string $tag): Builder
    {
        return $query->whereJsonContains('tags', $tag);
    }

    /**
     * Increment views
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get route key name for model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get SEO title
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->seo_meta['title'] ?? $this->title;
    }

    /**
     * Get SEO description
     */
    public function getSeoDescriptionAttribute(): string
    {
        return $this->seo_meta['description'] ?? $this->excerpt;
    }

    /**
     * Get SEO keywords
     */
    public function getSeoKeywordsAttribute(): string
    {
        return $this->seo_meta['keywords'] ?? implode(', ', $this->tags ?? []);
    }
}