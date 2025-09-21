<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'birth_date',
        'gender',
        'phone',
        'bio',
        'anonymous_mode',
        'anonymous_username',
        'consent_given',
        'consent_given_at',
        'email_notifications',
        'preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date' => 'date',
            'anonymous_mode' => 'boolean',
            'consent_given' => 'boolean',
            'consent_given_at' => 'datetime',
            'email_notifications' => 'boolean',
            'preferences' => 'array',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get display name (anonymous username if in anonymous mode)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->anonymous_mode && $this->anonymous_username 
            ? $this->anonymous_username 
            : $this->name;
    }

    /**
     * Get assessments
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Get counseling sessions
     */
    public function counselingSessions()
    {
        return $this->hasMany(CounselingSession::class);
    }

    /**
     * Get staff sessions (for staff users)
     */
    public function staffSessions()
    {
        return $this->hasMany(CounselingSession::class, 'staff_id');
    }

    /**
     * Get created content
     */
    public function createdContent()
    {
        return $this->hasMany(Content::class, 'created_by');
    }

    /**
     * Get authored blogs
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    /**
     * Get content interactions
     */
    public function contentInteractions()
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
}