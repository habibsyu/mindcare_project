<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CommunityLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'name',
        'url',
        'description',
        'icon',
        'member_count',
        'active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    /**
     * Scope for active links
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /**
     * Scope by platform
     */
    public function scopePlatform(Builder $query, string $platform): Builder
    {
        return $query->where('platform', $platform);
    }

    /**
     * Scope ordered by sort_order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get platform icon class
     */
    public function getPlatformIconAttribute(): string
    {
        return match ($this->platform) {
            'discord' => 'fab fa-discord',
            'telegram' => 'fab fa-telegram',
            default => 'fas fa-link',
        };
    }

    /**
     * Get platform color class
     */
    public function getPlatformColorAttribute(): string
    {
        return match ($this->platform) {
            'discord' => 'text-indigo-600',
            'telegram' => 'text-blue-600',
            default => 'text-gray-600',
        };
    }
}