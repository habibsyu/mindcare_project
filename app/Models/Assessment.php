<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_type',
        'answers',
        'score',
        'severity_level',
        'result',
        'recommendations',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'encrypted:array',
            'result' => 'encrypted:array',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the assessment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get test configuration
     */
    public function getTestConfigAttribute()
    {
        return config("assessments.{$this->test_type}");
    }

    /**
     * Calculate severity level based on score and test type
     */
    public static function calculateSeverityLevel(string $testType, int $score): string
    {
        $thresholds = config("assessments.{$testType}.thresholds");
        
        foreach ($thresholds as $level => $range) {
            if ($score >= $range['min'] && $score <= $range['max']) {
                return $level;
            }
        }
        
        return 'unknown';
    }

    /**
     * Generate recommendations based on assessment results
     */
    public static function generateRecommendations(string $testType, string $severityLevel): string
    {
        $recommendations = config("assessments.{$testType}.recommendations.{$severityLevel}");
        return $recommendations ?? 'Konsultasikan dengan profesional kesehatan mental.';
    }

    /**
     * Get the latest assessment for a user and test type
     */
    public static function getLatestForUser(int $userId, string $testType = null)
    {
        $query = self::where('user_id', $userId);
        
        if ($testType) {
            $query->where('test_type', $testType);
        }
        
        return $query->latest('completed_at')->first();
    }
}