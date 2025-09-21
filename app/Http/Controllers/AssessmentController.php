<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'consent']);
    }

    public function index()
    {
        $userAssessments = Auth::user()->assessments()
            ->latest('completed_at')
            ->get()
            ->groupBy('test_type');

        $availableTests = [
            'phq-9' => config('assessments.phq-9.name'),
            'gad-7' => config('assessments.gad-7.name'),
            'dass-21' => config('assessments.dass-21.name'),
        ];

        return view('assessments.index', compact('userAssessments', 'availableTests'));
    }

    public function show($type)
    {
        if (!in_array($type, ['phq-9', 'gad-7', 'dass-21'])) {
            abort(404);
        }

        $config = config("assessments.{$type}");
        $latestAssessment = Assessment::getLatestForUser(Auth::id(), $type);

        return view('assessments.show', compact('type', 'config', 'latestAssessment'));
    }

    public function take($type)
    {
        if (!in_array($type, ['phq-9', 'gad-7', 'dass-21'])) {
            abort(404);
        }

        $config = config("assessments.{$type}");

        return view('assessments.take', compact('type', 'config'));
    }

    public function submit(Request $request, $type)
    {
        if (!in_array($type, ['phq-9', 'gad-7', 'dass-21'])) {
            abort(404);
        }

        $config = config("assessments.{$type}");
        $questionsCount = count($config['questions']);

        $request->validate([
            'answers' => 'required|array|size:' . $questionsCount,
            'answers.*' => 'integer|min:0|max:3',
        ]);

        $answers = $request->answers;
        
        // Calculate score based on assessment type
        $score = $this->calculateScore($type, $answers);
        $severityLevel = Assessment::calculateSeverityLevel($type, $score);
        $recommendations = Assessment::generateRecommendations($type, $severityLevel);

        // Prepare result data
        $result = [
            'score' => $score,
            'severity_level' => $severityLevel,
            'test_type' => $type,
            'completed_at' => now(),
        ];

        // Add subscale scores for DASS-21
        if ($type === 'dass-21') {
            $subscales = $this->calculateDassSubscales($answers);
            $result['subscales'] = $subscales;
        }

        $assessment = Assessment::create([
            'user_id' => Auth::id(),
            'test_type' => $type,
            'answers' => $answers,
            'score' => $score,
            'severity_level' => $severityLevel,
            'result' => $result,
            'recommendations' => $recommendations,
            'completed_at' => now(),
        ]);

        return redirect()->route('assessments.result', $assessment->id)
            ->with('success', 'Assessment berhasil diselesaikan!');
    }

    public function result(Assessment $assessment)
    {
        if ($assessment->user_id !== Auth::id()) {
            abort(403);
        }

        $config = config("assessments.{$assessment->test_type}");
        
        // Get recommended content based on assessment results
        $recommendedContent = $this->getRecommendedContent($assessment);

        return view('assessments.result', compact('assessment', 'config', 'recommendedContent'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $assessments = $user->assessments()
            ->latest('completed_at')
            ->get();

        $latestAssessments = [];
        foreach (['phq-9', 'gad-7', 'dass-21'] as $type) {
            $latest = $assessments->where('test_type', $type)->first();
            if ($latest) {
                $latestAssessments[$type] = $latest;
            }
        }

        // Get assessment history for charts
        $assessmentHistory = $user->assessments()
            ->selectRaw('test_type, score, severity_level, completed_at')
            ->orderBy('completed_at')
            ->get()
            ->groupBy('test_type');

        $recommendedContent = $this->getRecommendedContentForUser($user);

        return view('assessments.dashboard', compact(
            'latestAssessments', 
            'assessmentHistory', 
            'recommendedContent'
        ));
    }

    private function calculateScore($type, $answers)
    {
        return array_sum($answers);
    }

    private function calculateDassSubscales($answers)
    {
        $config = config('assessments.dass-21');
        $subscales = [];

        foreach ($config['subscales'] as $subscale => $questionNumbers) {
            $score = 0;
            foreach ($questionNumbers as $questionNumber) {
                $score += $answers[$questionNumber - 1]; // Convert to 0-based index
            }
            
            // DASS-21 scores are multiplied by 2
            $score *= 2;
            
            $subscales[$subscale] = [
                'score' => $score,
                'level' => $this->getDassSubscaleLevel($subscale, $score)
            ];
        }

        return $subscales;
    }

    private function getDassSubscaleLevel($subscale, $score)
    {
        $thresholds = config("assessments.dass-21.thresholds.{$subscale}");
        
        foreach ($thresholds as $level => $range) {
            if ($score >= $range['min'] && $score <= $range['max']) {
                return $level;
            }
        }
        
        return 'unknown';
    }

    private function getRecommendedContent(Assessment $assessment)
    {
        // Logic to recommend content based on assessment results
        $category = match ($assessment->severity_level) {
            'minimal', 'normal' => 'wellness',
            'mild' => 'self-help',
            'moderate', 'moderately_severe' => 'coping-strategies',
            'severe', 'extremely_severe' => 'professional-help',
            default => 'general'
        };

        return Content::published()
            ->where('category', $category)
            ->latest('published_at')
            ->limit(6)
            ->get();
    }

    private function getRecommendedContentForUser($user)
    {
        $latestAssessment = $user->assessments()->latest('completed_at')->first();
        
        if (!$latestAssessment) {
            return Content::published()
                ->featured()
                ->limit(6)
                ->get();
        }

        return $this->getRecommendedContent($latestAssessment);
    }
}