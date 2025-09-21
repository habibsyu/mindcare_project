<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotService
{
    protected $n8nWebhookUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->n8nWebhookUrl = config('services.n8n.webhook_url');
        $this->apiKey = config('services.n8n.api_key');
    }

    /**
     * Get bot response from N8N webhook
     */
    public function getBotResponse(string $message, array $conversationHistory = []): string
    {
        try {
            if (!$this->n8nWebhookUrl) {
                return $this->getFallbackResponse($message);
            }

            $response = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Content-Type' => 'application/json',
                ])
                ->post($this->n8nWebhookUrl, [
                    'message' => $message,
                    'history' => $this->formatConversationHistory($conversationHistory),
                    'context' => 'mental_health_support',
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['response'] ?? $this->getFallbackResponse($message);
            }

            Log::warning('N8N API request failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return $this->getFallbackResponse($message);

        } catch (\Exception $e) {
            Log::error('Chatbot service error', [
                'message' => $e->getMessage(),
                'user_message' => $message,
            ]);

            return $this->getFallbackResponse($message);
        }
    }

    /**
     * Check if conversation needs human intervention
     */
    public function needsHumanIntervention(string $message): bool
    {
        $criticalKeywords = [
            'bunuh diri', 'suicide', 'mengakhiri hidup', 'mati saja',
            'tidak ada harapan', 'hopeless', 'putus asa',
            'menyakiti diri', 'self harm', 'cutting',
            'krisis', 'emergency', 'darurat',
        ];

        $message = strtolower($message);
        
        foreach ($criticalKeywords as $keyword) {
            if (str_contains($message, strtolower($keyword))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Format conversation history for API
     */
    private function formatConversationHistory(array $messages): array
    {
        return collect($messages)->map(function ($message) {
            return [
                'role' => $message['type'] === 'user' ? 'user' : 'assistant',
                'content' => $message['content'],
                'timestamp' => $message['timestamp'],
            ];
        })->toArray();
    }

    /**
     * Get fallback response when API is unavailable
     */
    private function getFallbackResponse(string $message): string
    {
        $responses = [
            'Saya mendengar Anda. Bisakah Anda ceritakan lebih lanjut tentang perasaan Anda?',
            'Terima kasih telah berbagi. Apa yang paling membuat Anda khawatir saat ini?',
            'Saya memahami bahwa ini mungkin sulit. Bagaimana saya bisa membantu Anda?',
            'Perasaan yang Anda alami itu valid. Apakah ada hal spesifik yang ingin Anda diskusikan?',
            'Saya di sini untuk mendengarkan. Apa yang ada di pikiran Anda sekarang?',
        ];

        // Simple keyword-based responses
        $message = strtolower($message);
        
        if (str_contains($message, 'sedih') || str_contains($message, 'depresi')) {
            return 'Saya memahami bahwa Anda merasa sedih. Perasaan seperti ini memang berat. Sudah berapa lama Anda merasakan ini?';
        }
        
        if (str_contains($message, 'cemas') || str_contains($message, 'khawatir')) {
            return 'Kecemasan memang bisa membuat tidak nyaman. Apa yang paling membuat Anda cemas saat ini?';
        }
        
        if (str_contains($message, 'stress') || str_contains($message, 'tertekan')) {
            return 'Stress bisa sangat menantang. Apakah ada pemicu spesifik yang membuat Anda merasa tertekan?';
        }

        return $responses[array_rand($responses)];
    }
}