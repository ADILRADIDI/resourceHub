<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Authentification
use App\Http\Controllers\AuthController;
// managment posts
use App\Http\Controllers\PostController;
// managment podcast
use App\Http\Controllers\PodcastController;
// managment Tag
use App\Http\Controllers\TagController;
// managment postTag
use App\Http\Controllers\PostTagController;
// managment bookmarks
use App\Http\Controllers\BookmarkController;
// managment comments 
use App\Http\Controllers\CommentController;
// managment YT-channelss
use App\Http\Controllers\YouTubeChannelController;
// managment events
use App\Http\Controllers\EventController;
// managment registriation in events s
use App\Http\Controllers\EventRegistrationController;

// api stackexchange questions and answers. 
use App\Http\Controllers\Api\StackExchangeController;

// ApI linked-in jobs
use App\Http\Controllers\LinkedInJobController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
// logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// posts
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

// managment podcast
Route::apiResource('podcasts', PodcastController::class)->middleware('auth:sanctum');

// managment tags  
Route::apiResource('tags', TagController::class)->middleware('auth:sanctum');

// managment postTag
Route::apiResource('postTags', PostTagController::class)->middleware('auth:sanctum');

// managment bookmarks
Route::apiResource('bookmarks', BookmarkController::class)->middleware('auth:sanctum');

// managment comments 
Route::apiResource('comments', CommentController::class)->middleware('auth:sanctum');

// managment YT-channelss (not working 100%).
Route::apiResource('youtubeChannels', YouTubeChannelController::class)->middleware('auth:sanctum');

// managment events
Route::apiResource('events', EventController::class)->middleware('auth:sanctum');

// register user in event
Route::post('events/{event}/register', [EventRegistrationController::class,'register'])->middleware('auth:sanctum');

// stackExchange for Questions
Route::get('/stackexchange/questions', [StackExchangeController::class, 'getQuestions']);
Route::get('/stackexchange/questions/{id}/answers', [StackExchangeController::class, 'getAnswers']);


// crash course a youtube you can search pro
use App\Http\Controllers\YouTubeController;
Route::get('/youtube', [YouTubeController::class, 'search'])->middleware('auth:sanctum');

// authentifiaction with google button (login/register)
// use App\Http\Controllers\GoogleController;

// Route::middleware(['web'])->group(function () {
//     Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
//     Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// });

// LINKEDIN JOBS
// Route::get('/linkedin/token', [LinkedInJobController::class, 'getAccessToken']);
// Route::get('/linkedin/jobs', [LinkedInJobController::class, 'getJobs']);