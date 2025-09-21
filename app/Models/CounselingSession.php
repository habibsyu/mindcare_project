<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CounselingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_id',
        'session_id',
        'messages',
        'status',
        'mode',
        'transferred_at',
        'transfer_reason',
        'session_summary',
        'rating',
        'feedback',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'messages' => 'encrypted:array',
            'transferred_at' => 'datetime',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($session) {
            if (empty($session->session_id)) {
                $session->session_id = \Str::uuid()->toString();
            }
            
            if (empty($session->started_at)) {
                $session->started_at = now();
            }
        });
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff member
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Scope for active sessions
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for completed sessions
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope by mode
     */
    public function scopeMode(Builder $query, string $mode): Builder
    {
        return $query->where('mode', $mode);
    }

    /**
     * Add message to session
     */
    public function addMessage(array $message): void
    {
        $messages = $this->messages ?? [];
        $messages[] = array_merge($message, [
            'timestamp' => now()->toISOString(),
            'id' => \Str::uuid()->toString(),
        ]);
        
        $this->update(['messages' => $messages]);
    }

    /**
     * Transfer session to staff
     */
    public function transferToStaff(int $staffId, string $reason = null): bool
    {
        return $this->update([
            'staff_id' => $staffId,
            'status' => 'transferred',
            'mode' => 'human_staff',
            'transferred_at' => now(),
            'transfer_reason' => $reason,
        ]);
    }

    /**
     * Complete session
     */
    public function complete(string $summary = null): bool
    {
        return $this->update([
            'status' => 'completed',
            'ended_at' => now(),
            'session_summary' => $summary,
        ]);
    }

    /**
     * Get session duration in minutes
     */
    public function getDurationAttribute(): ?int
    {
        if (!$this->ended_at) {
            return null;
        }
        
        return $this->started_at->diffInMinutes($this->ended_at);
    }

    /**
     * Check if session is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if session is using AI bot
     */
    public function isAiMode(): bool
    {
        return $this->mode === 'ai_bot';
    }

    /**
     * Check if session is with human staff
     */
    public function isHumanMode(): bool
    {
        return $this->mode === 'human_staff';
    }
}