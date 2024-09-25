<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StackExchangeService;
use Illuminate\Http\Request;

class StackExchangeController extends Controller
{
    protected $stackExchangeService;

    public function __construct(StackExchangeService $stackExchangeService)
    {
        $this->stackExchangeService = $stackExchangeService;
    }

    public function getQuestions(Request $request)
    {
        // Retrieve tags from the request, defaulting to 'php'
        $tags = $request->query('tags', 'php');

        // Fetch questions from the Stack Exchange service
        $questions = $this->stackExchangeService->fetchQuestions($tags);

        // Check for errors in fetching questions
        if (isset($questions['error'])) {
            \Log::error('Error fetching questions: ', $questions);
            return response()->json(['error' => $questions['error']], 500);
        }

        // Check if there are items in the response
        if (!isset($questions['items']) || empty($questions['items'])) {
            return response()->json(['error' => 'No data found'], 404);
        }

        // Filter questions to only include those that are answered
        $answeredQuestions = array_filter($questions['items'], function ($question) {
            return isset($question['is_answered']) && $question['is_answered'] === true;
        });

        // Check if there are any answered questions
        if (empty($answeredQuestions)) {
            return response()->json(['error' => 'No answered questions found'], 404);
        }

        // Return only the answered questions with a 200 status code
        return response()->json(array_values($answeredQuestions), 200);
    }

    public function getAnswers($id)
    {
        $answers = $this->stackExchangeService->fetchAnswers($id);

        if (isset($answers['error'])) {
            return response()->json(['error' => $answers['error']], 500);
        }

        return response()->json($answers['items'] ?? [], 200);
    }
}
