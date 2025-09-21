<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id',
        'answers',
        'score',
        'total_questions',
        'completed',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'completed' => 'boolean',
        ];
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quiz content
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * Calculate score percentage
     */
    public function getScorePercentageAttribute(): float
    {
        if ($this->total_questions === 0) {
            return 0;
        }
        
        return round(($this->score / $this->total_questions) * 100, 2);
    }

    /**
     * Check if user passed the quiz (>= 70%)
     */
    public function getPassedAttribute(): bool
    {
        return $this->score_percentage >= 70;
    }

    /**
     * Get the latest attempt for a user and quiz
     */
    public static function getLatestForUser(int $userId, int $contentId)
    {
        return static::where('user_id', $userId)
                    ->where('content_id', $contentId)
                    ->latest()
                    ->first();
    }
}