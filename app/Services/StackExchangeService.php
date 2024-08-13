<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class StackExchangeService
{
    protected $apiUrl = 'https://api.stackexchange.com/2.3/questions';

    public function fetchQuestions($tag)
    {
        try {
            $response = Http::get($this->apiUrl, [
                'order' => 'desc',
                'sort' => 'activity',
                'site' => 'stackoverflow',
                'tagged' => $tag,
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                return ['error' => 'API request failed'];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
