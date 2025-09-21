<?php

namespace App\Http\Controllers;

use App\Models\CounselingSession;
use App\Services\ChatbotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CounselingController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->middleware(['auth', 'consent']);
        $this->chatbotService = $chatbotService;
    }

    public function index()
    {
        $activeSessions = Auth::user()
            ->counselingSessions()
            ->active()
            ->latest('started_at')
            ->get();

        $completedSessions = Auth::user()
            ->counselingSessions()
            ->completed()
            ->latest('ended_at')
            ->limit(10)
            ->get();

        return view('counseling.index', compact('activeSessions', 'completedSessions'));
    }

    public function start()
    {
        // Check if user has active session
        $activeSession = Auth::user()
            ->counselingSessions()
            ->active()
            ->first();

        if ($activeSession) {
            return redirect()->route('counseling.chat', $activeSession->session_id);
        }

        // Create new session
        $session = CounselingSession::create([
            'user_id' => Auth::id(),
            'session_id' => Str::uuid(),
            'messages' => [],
            'status' => 'active',
            'mode' => 'ai_bot',
            'started_at' => now(),
        ]);

        // Add welcome message
        $welcomeMessage = [
            'type' => 'bot',
            'content' => 'Halo! Saya adalah chatbot MindCare. Saya di sini untuk mendengarkan dan memberikan dukungan. Bagaimana perasaan Anda hari ini?',
            'timestamp' => now()->toISOString(),
        ];

        $session->addMessage($welcomeMessage);

        return redirect()->route('counseling.chat', $session->session_id);
    }

    public function chat($sessionId)
    {
        $session = CounselingSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$session->isActive()) {
            return redirect()->route('counseling.index')
                ->with('error', 'Sesi konseling sudah berakhir.');
        }

        return view('counseling.chat', compact('session'));
    }

    public function sendMessage(Request $request, $sessionId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $session = CounselingSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$session->isActive()) {
            return response()->json(['error' => 'Session is not active'], 400);
        }

        // Add user message
        $userMessage = [
            'type' => 'user',
            'content' => $request->message,
            'timestamp' => now()->toISOString(),
        ];
        $session->addMessage($userMessage);

        // Get bot response
        if ($session->isAiMode()) {
            try {
                $botResponse = $this->chatbotService->getBotResponse(
                    $request->message, 
                    $session->messages
                );

                $botMessage = [
                    'type' => 'bot',
                    'content' => $botResponse,
                    'timestamp' => now()->toISOString(),
                ];
                $session->addMessage($botMessage);

                // Check if conversation needs human intervention
                if ($this->chatbotService->needsHumanIntervention($request->message)) {
                    return response()->json([
                        'message' => $botMessage,
                        'needs_human' => true,
                        'transfer_message' => 'Saya merasa percakapan ini memerlukan bantuan dari konselor manusia. Apakah Anda ingin saya menghubungkan Anda dengan staf kami?'
                    ]);
                }

            } catch (\Exception $e) {
                $botMessage = [
                    'type' => 'bot',
                    'content' => 'Maaf, saya mengalami kesulitan teknis. Mari kita coba lagi, atau saya dapat menghubungkan Anda dengan konselor manusia.',
                    'timestamp' => now()->toISOString(),
                ];
                $session->addMessage($botMessage);
            }
        }

        return response()->json([
            'message' => $botMessage ?? null,
        ]);
    }

    public function requestHumanTransfer($sessionId)
    {
        $session = CounselingSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$session->isActive()) {
            return response()->json(['error' => 'Session is not active'], 400);
        }

        // Find available staff
        $availableStaff = \App\Models\User::where('role', 'staff')
            ->whereDoesntHave('staffSessions', function($query) {
                $query->where('status', 'active');
            })
            ->first();

        if (!$availableStaff) {
            $message = [
                'type' => 'system',
                'content' => 'Maaf, saat ini tidak ada konselor yang tersedia. Tim kami akan menghubungi Anda sesegera mungkin.',
                'timestamp' => now()->toISOString(),
            ];
            $session->addMessage($message);

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada konselor yang tersedia saat ini.'
            ]);
        }

        // Transfer to human staff
        $session->transferToStaff($availableStaff->id, 'User requested human assistance');

        $transferMessage = [
            'type' => 'system',
            'content' => "Anda telah terhubung dengan konselor kami, {$availableStaff->name}. Mereka akan segera bergabung dalam percakapan.",
            'timestamp' => now()->toISOString(),
        ];
        $session->addMessage($transferMessage);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil terhubung dengan konselor manusia.'
        ]);
    }

    public function endSession($sessionId)
    {
        $session = CounselingSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$session->isActive()) {
            return response()->json(['error' => 'Session is not active'], 400);
        }

        $session->complete('Session ended by user');

        return response()->json(['success' => true]);
    }

    public function rateSession(Request $request, $sessionId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $session = CounselingSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $session->update([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return response()->json(['success' => true]);
    }

    public function history()
    {
        $sessions = Auth::user()
            ->counselingSessions()
            ->completed()
            ->latest('ended_at')
            ->paginate(10);

        return view('counseling.history', compact('sessions'));
    }
}