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

//my profile 
use App\Http\Controllers\ProfileController;

// manage reactions
use App\Http\Controllers\ReactionController;

// managment followers ...
use App\Http\Controllers\FollowController;

// CREASH COURSE
use App\Http\Controllers\YouTubeController;

// CREASH COURSE
use App\Http\Controllers\UserController;

// CREASH COURSE
use App\Http\Controllers\RoleController;

// CREASH COURSE
use App\Http\Controllers\PermissionController;




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


// managment posts
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

// managment podcast and search by title
Route::apiResource('podcasts', PodcastController::class)->middleware('auth:sanctum');
// not working 100%
Route::get('/podcasts/search', [PodcastController::class, 'search'])->middleware('auth:sanctum');

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
// seach youtube Channels
Route::get('youtube-channels/search', [YouTubeChannelController::class, 'search'])->middleware('auth:sanctum');

// managment events
Route::apiResource('events', EventController::class)->middleware('auth:sanctum');
// search || not working 100%
Route::get('events/search', [EventController::class, 'search'])->middleware('auth:sanctum');

// register user in event
Route::post('events/{event}/register', [EventRegistrationController::class,'register'])->middleware('auth:sanctum');

// stackExchange for Questions
Route::get('/stackexchange/questions', [StackExchangeController::class, 'getQuestions']);
Route::get('/stackexchange/questions/{id}/answers', [StackExchangeController::class, 'getAnswers']);

// reactions
Route::apiResource('reactions', ReactionController::class)->middleware('auth:sanctum');

// crash course a youtube you can search pro
Route::get('/youtube', [YouTubeController::class, 'search'])->middleware('auth:sanctum');

//update my profile
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/profile/name', [ProfileController::class, 'updateName']);
    Route::post('/profile/email', [ProfileController::class, 'updateEmail']);
    Route::post('/profile/password', [ProfileController::class, 'updatePassword']);
    Route::post('/profile/bio', [ProfileController::class, 'updateBio']);
    Route::post('/profile/profile-picture', [ProfileController::class, 'updateProfilePicture']);
    Route::post('/profile/website', [ProfileController::class, 'updateWebsite']);
    Route::post('/profile/location', [ProfileController::class, 'updateLocation']);
    Route::post('/profile/position', [ProfileController::class, 'updatePosition']);
    Route::delete('/profile/delete-account', [ProfileController::class, 'deleteAccount']);
    // update brand_color for set in background color in profile
    Route::post('/profile/brand-color', [ProfileController::class, 'updateBrandColor']);
});

// authentifiaction with google button (login/register)
// use App\Http\Controllers\GoogleController;

// Route::middleware(['web'])->group(function () {
//     Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
//     Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// });

// LINKEDIN JOBS
// Route::get('/linkedin/token', [LinkedInJobController::class, 'getAccessToken']);
// Route::get('/linkedin/jobs', [LinkedInJobController::class, 'getJobs']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/follow/{id}', [FollowController::class, 'follow']);
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow']);
    // get followers li mtb3ino by this user (id)
    Route::get('/followers/{id}', [FollowController::class, 'followers']);
    // get following li mtaba3 howa by this user (id)
    Route::get('/following/{id}', [FollowController::class, 'following']);
});


Route::apiResource('permissions', PermissionController::class);

Route::apiResource('roles', RoleController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users', [UserController::class, 'store']);
    // get all
    Route::get('/users', [UserController::class, 'index']);
    });
Route::get('/users/{id}', [UserController::class, 'show']);