<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id',
        'type',
    ];

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the content
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * Create or update interaction
     */
    public static function createOrUpdate(int $userId, int $contentId, string $type): self
    {
        return static::updateOrCreate([
            'user_id' => $userId,
            'content_id' => $contentId,
            'type' => $type,
        ]);
    }

    /**
     * Toggle interaction (like/bookmark)
     */
    public static function toggle(int $userId, int $contentId, string $type): bool
    {
        $interaction = static::where([
            'user_id' => $userId,
            'content_id' => $contentId,
            'type' => $type,
        ])->first();

        if ($interaction) {
            $interaction->delete();
            return false; // Removed
        } else {
            static::create([
                'user_id' => $userId,
                'content_id' => $contentId,
                'type' => $type,
            ]);
            return true; // Added
        }
    }
}