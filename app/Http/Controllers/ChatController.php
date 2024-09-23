<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class ChatController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        $question = $request->input('question');
        $response = $this->openAIService->askQuestion($question);

        return response()->json($response);
    }
}
