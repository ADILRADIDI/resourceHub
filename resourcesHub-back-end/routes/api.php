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

// CREASH COURSE from youtube
use App\Http\Controllers\YouTubeController;

// managment users
use App\Http\Controllers\UserController;

// managment roles
use App\Http\Controllers\RoleController;

// managment permissions
use App\Http\Controllers\PermissionController;

// follow and unfolloow tags
use App\Http\Controllers\FollowTagController;




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
// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
// Route::post('acceptPost', [PostController::class, 'acceptPost'])->middleware('auth:sanctum');
// Route::post('getDraftPosts', [PostController::class, 'getDraftPosts'])->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
Route::post('acceptPost/{id}', [PostController::class , 'acceptPost'])->middleware('auth:sanctum');
Route::get('getDraftPosts', [PostController::class, 'getDraftPosts'])->middleware('auth:sanctum');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');


Route::post('/posts/search', [PostController::class, 'search'])->middleware('auth:sanctum');
Route::post('/posts/by-tag', [PostController::class, 'getPostsByTag'])->middleware('auth:sanctum');


// managment podcast and search by title
// Route::apiResource('podcasts', PodcastController::class)->middleware('auth:sanctum');
Route::post('publishPodcast/{id}', [PodcastController::class, 'publishPodcast'])->middleware('auth:sanctum');
Route::get('getAllpd', [PodcastController::class, 'getAllpd'])->middleware('auth:sanctum');
Route::put('podcasts/{id}', [PodcastController::class, 'update'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('podcasts', PodcastController::class);
    Route::get('podcasts/search', [PodcastController::class, 'search']);
    Route::post('podcasts/{podcast}/publish', [PodcastController::class, 'publishPodcast']);
});

// search podcastgetp
Route::post('/podcasts/search', [PodcastController::class, 'search'])->middleware('auth:sanctum');

// managment tags
Route::apiResource('tags', TagController::class)->middleware('auth:sanctum');
Route::put('tags', [TagController::class, 'update'])->middleware('auth:sanctum');
Route::get('getAllTags', [TagController::class, 'getAllTags'])->middleware('auth:sanctum');
Route::patch('tags/{id}/publish', [TagController::class, 'publish'])->middleware('auth:sanctum'); // Add route for publishing


Route::get('/tags/by-name/{name}', [TagController::class, 'getByName'])->middleware('auth:sanctum');
Route::get('/tag/popular', [TagController::class, 'getPopularTags'])->middleware('auth:sanctum');


// managment postTag
Route::apiResource('postTags', PostTagController::class)->middleware('auth:sanctum');

// managment bookmarks
Route::apiResource('bookmarks', BookmarkController::class)->middleware('auth:sanctum');
Route::post('/bookmarks/{id}/archive', [BookmarkController::class, 'archive'])->middleware('auth:sanctum');


// managment comments
Route::apiResource('comments', CommentController::class)->middleware('auth:sanctum');
Route::get('/comments/post/{postId}', [CommentController::class, 'getCommentsByPostId'])->middleware('auth:sanctum');


// managment YT-channelss (i can change search to buttons).
Route::apiResource('youtubeChannels', YouTubeChannelController::class)->middleware('auth:sanctum');
// Route::post('publishChannel', YouTubeChannelController::class)->middleware('auth:sanctum');
Route::Get('getAllYt', [YouTubeChannelController::class, 'getAllYt'])->middleware('auth:sanctum');
Route::post('youtubeChannelsAdmin/{id}', [YouTubeChannelController::class, 'publishChannel'])->middleware('auth:sanctum');
// search youtube Channels
Route::get('youtube-channels/search', [YouTubeChannelController::class, 'search'])->middleware('auth:sanctum');

// managment events
Route::apiResource('events', EventController::class)->middleware('auth:sanctum');
Route::delete('events/{event}', [EventController::class, 'destroy'])->middleware('auth:sanctum');

// search || not working 100%
Route::post('events/search', [EventController::class, 'search'])->middleware('auth:sanctum');
// register user in event
Route::post('events/{event}/register', [EventRegistrationController::class,'register'])->middleware('auth:sanctum');

// stackExchange for Questions
Route::get('/stackexchange/questions', [StackExchangeController::class, 'getQuestions']);
Route::get('/stackexchange/questions/{id}/answers', [StackExchangeController::class, 'getAnswers']);



 
// reactions
Route::apiResource('reactions', ReactionController::class)->middleware('auth:sanctum');

// crash course a youtube you can search pro
Route::get('/youtube', [YouTubeController::class, 'search'])->middleware('auth:sanctum');

use App\Http\Controllers\StatistiqueAdmin;
Route::get('/getTotalPosts', [StatistiqueAdmin::class, 'getTotalPosts'])->middleware('auth:sanctum');
Route::get('/getDraftItems', [StatistiqueAdmin::class, 'getDraftItems'])->middleware('auth:sanctum');


use App\Http\Controllers\ProgrammingDataController;
Route::get('/programming-data', [ProgrammingDataController::class, 'index']);

// setting user .... . . . .
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/{userId}', [ProfileController::class, 'getUserProfile']);
    Route::post('/profile/update/name', [ProfileController::class, 'updateName']);
    Route::post('/profile/update/email', [ProfileController::class, 'updateEmail']);
    Route::post('/profile/update/password', [ProfileController::class, 'updatePassword']);
    Route::post('/profile/update/bio', [ProfileController::class, 'updateBio']);
    Route::post('/profile/update/skills', [ProfileController::class, 'updateSkills']);
    Route::post('/profile/update/github', [ProfileController::class, 'updateGithub']);
    Route::post('/profile/updatepicture', [ProfileController::class, 'updateProfilePicture']);
    Route::post('/profile/update/website', [ProfileController::class, 'updateWebsite']);
    Route::post('/profile/update/location', [ProfileController::class, 'updateLocation']);
    Route::post('/profile/update/position', [ProfileController::class, 'updatePosition']);
    Route::post('/profile/update/brand-color', [ProfileController::class, 'updateBrandColor']);
    Route::post('/profile/update/is-premium', [ProfileController::class, 'updateIsPremium']);
    Route::post('/profile/update/birthday', [ProfileController::class, 'updateBirthday']);
    Route::delete('/profile/delete-account', [ProfileController::class, 'deleteAccount']);
    Route::get('/profile/completion', [ProfileController::class, 'checkProfileCompletion']);
});


Route::middleware('auth:sanctum')->get('/profileCompletion', [ProfileController::class, 'checkProfileCompletion']);


// Follow a tag and Unfollow a tags
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tags/{id}/follow', [FollowTagController::class, 'follow']);
    Route::delete('/tags/{id}/unfollow', [FollowTagController::class, 'unfollow']);
});
Route::get('/tags/{id}/is-following', [FollowTagController::class, 'isFollowing'])->middleware('auth:sanctum');

// managment followers and following and follw and unfollow
// Management of followers and following
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/follow/{id}', [FollowController::class, 'follow']);
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow']);
    // Get followers of a user (by user id)
    Route::get('/followers/{id}', [FollowController::class, 'followers']);
    // Get users that a user is following (by user id)
    Route::get('/following/{id}', [FollowController::class, 'following']);
    // Check if the current user is following another user
    Route::get('/isf/{id}', [FollowController::class, 'isFollowing']);
});

// managment permissions
Route::apiResource('permissions', PermissionController::class);
// managment roles and assign permissions to role is created
Route::apiResource('roles', RoleController::class);

// managment users and enter role for this user
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users', [UserController::class, 'store']);
    // get all
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    });

// managment ResourceDev
use App\Http\Controllers\CategoryController;
Route::resource('categories', CategoryController::class);

// managment resources
use App\Http\Controllers\ResourceController;
Route::resource('resources', ResourceController::class);

// managment Suggested Tag
// use App\Http\Controllers\SuggestedTagController;
// Route::apiResource('suggested-tags', SuggestedTagController::class)->middleware('auth:sanctum');
// Route::get('getAllD', SuggestedTagController::class ,'getDraftTags')->middleware('auth:sanctum');


use App\Http\Controllers\SuggestedTagController;
Route::apiResource('suggested-tags', SuggestedTagController::class)->middleware('auth:sanctum');
// Corrected route to retrieve all draft tags
Route::get('getAllD', [SuggestedTagController::class, 'getDraftTags'])->middleware('auth:sanctum');
// Corrected route to accept a suggested tag
Route::post('suggested-tags/{id}/accept', [SuggestedTagController::class, 'acceptTag'])->middleware('auth:sanctum');
Route::delete('suggested-tags/{id}/reject', [SuggestedTagController::class, 'destroy'])->middleware('auth:sanctum');
Route::delete('suggested-tags/{id}', [SuggestedTagController::class, 'destroy'])->middleware('auth:sanctum');


use App\Http\Controllers\AdController;
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('ads', AdController::class);
});


// managment Suggested Yt Channel
use App\Http\Controllers\SuggestedYtChannelController;
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('suggested-yt-channels', SuggestedYtChannelController::class);
    Route::post('accept-suggested-channel/{id}', [SuggestedYtChannelController::class, 'acceptSuggestedChannel']);
    Route::get('getAll', [SuggestedYtChannelController::class, 'getDraftChannels']);
});

//managment suggested podcasts and i used function only $/exccept
use App\Http\Controllers\SuggestedPodcastController;
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('suggested-podcasts', SuggestedPodcastController::class)->only([
        'index', 'store', 'destroy'
    ]);
    // Route::post('suggested-podcasts/{id}/accept', [SuggestedPodcastController::class, 'accept']);
    // Route::post('suggested-podcasts/{id}/reject', [SuggestedPodcastController::class, 'reject']);
});



    // notif beafore add in database
    use App\Http\Controllers\NotificationController;
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->middleware('auth:sanctum');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->middleware('auth:sanctum');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->middleware('auth:sanctum');
    Route::delete('/notifications', [NotificationController::class, 'clearNotifications'])->middleware('auth:sanctum');


// like post and craet notification
use App\Http\Controllers\LikeController;
Route::middleware('auth:sanctum')->group(function () {
    // Route to like a post
    Route::post('/like', [LikeController::class, 'store']);
    // deslike  a post
    Route::delete('/like', [LikeController::class, 'destroy']);

});

use App\Http\Controllers\ChatController;
Route::post('/ask', [ChatController::class, 'ask']);


use App\Http\Controllers\Auth\SocialController;

Route::get('auth/github', [SocialController::class, 'redirectToGitHub']);
Route::get('auth/github/callback', [SocialController::class, 'handleGitHubCallback']);

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/gitlab', [SocialController::class, 'redirectToGitLab']);
Route::get('auth/gitlab/callback', [SocialController::class, 'handleGitLabCallback']);














// not working 100%
use App\Http\Controllers\PasswordResetController;
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'reset']);




// authentifiaction with google button (login/register)
// use App\Http\Controllers\GoogleController;

// Route::middleware(['web'])->group(function () {
//     Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
//     Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// });




