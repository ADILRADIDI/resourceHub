<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class StackExchangeService
{
    protected $baseUrl = 'https://api.stackexchange.com/2.3';
    protected $apiKey = 'rl_RKNgzMurrb66fyGzP5N3ubapZ'; // Ensure this is correct

    public function fetchQuestions($tags)
    {
        $response = Http::get("{$this->baseUrl}/questions", [
            'order' => 'desc',
            'sort' => 'activity',
            'site' => 'stackoverflow',
            'tagged' => $tags,
            'key' => $this->apiKey,
        ]);

        \Log::info('Stack Exchange Questions Response:', $response->json());

        return $response->json();
    }

    public function fetchAnswers($questionId)
    {
        $response = Http::get("{$this->baseUrl}/questions/{$questionId}/answers", [
            'order' => 'desc',
            'sort' => 'activity',
            'site' => 'stackoverflow',
            'filter' => 'withbody',
            'key' => $this->apiKey,
        ]);

        \Log::info('Stack Exchange Answers Response:', $response->json());

        return $response->json();
    }
}
