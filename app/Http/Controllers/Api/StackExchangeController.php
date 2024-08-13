<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StackExchangeService;
use Illuminate\Http\Request;

// testing just..
// https://api.stackexchange.com/2.3/questions?order=desc&sort=activity&site=stackoverflow&tagged=laravel

// testing get answer by question id 
// https://api.stackexchange.com/2.3/questions/78867456/answers?order=desc&sort=activity&site=stackoverflow&filter=withbody

class StackExchangeController extends Controller
{
    protected $stackExchangeService;

    public function __construct(StackExchangeService $stackExchangeService)
    {
        $this->stackExchangeService = $stackExchangeService;
    }

        public function getQuestions(Request $request)
    {
        $tag = $request->query('tag', 'php');
        $questions = $this->stackExchangeService->fetchQuestions($tag);

        if (isset($questions['error'])) {
            return response()->json(['error' => $questions['error']], 500);
        }

        if (!isset($questions['items']) || empty($questions['items'])) {
            return response()->json(['error' => 'No data found'], 404);
        }

        $simplifiedQuestions = array_map(function ($question) {
            return [
                'title' => $question['title'],
                'link' => $question['link'],
                'owner' => [
                    'display_name' => $question['owner']['display_name'],
                    'profile_image' => $question['owner']['profile_image'],
                    'link' => $question['owner']['link'],
                ],
                'tags' => $question['tags'],
                'is_answered' => $question['is_answered'],
                'view_count' => $question['view_count'],
                'answer_count' => $question['answer_count'],
            ];
        }, $questions['items']);

        return response()->json($simplifiedQuestions, 200);
    }

    


    public function getAnswers($id)
    {
        $answers = $this->stackExchangeService->fetchAnswers($id);

        if (isset($answers['error'])) {
            return response()->json(['error' => $answers['error']], 500);
        }

        // Simplify the response
        $simplifiedAnswers = array_map(function ($answer) {
            return [
                'answer_id' => $answer['answer_id'],
                'is_accepted' => $answer['is_accepted'],
                'score' => $answer['score'],
                'owner' => [
                    'display_name' => $answer['owner']['display_name'],
                    'profile_image' => $answer['owner']['profile_image'],
                    'link' => $answer['owner']['link'],
                ],
            ];
        }, $answers['items'] ?? []);

        return response()->json($simplifiedAnswers, 200);
    }
}
