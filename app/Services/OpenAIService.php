<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function askQuestion($question)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            // from documentation openapi
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo', // Or use 'gpt-4' if you have access
            'messages' => [
                ['role' => 'user', 'content' => $question],
            ],
            'max_tokens' => 150,
        ]);

        return $response->json();
    }
}
