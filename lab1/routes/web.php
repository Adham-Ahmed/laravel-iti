<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Auth;
Route::middleware('auth')->group(function() {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/create/', [PostController::class, 'create']);
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/update/{id}', [PostController::class, 'update']);
    Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy']);
    Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{post}/comments/{comment}/delete', [CommentController::class, 'delete'])->name('comments.delete');
    Route::get('/posts/{post}/comments/{comment}/restore', [CommentController::class, 'restore'])->name('comments.restore');
    Route::get('/posts/edit/{toEdit}', [PostController::class, 'edit']);
    Route::get('/posts/delete/{toDelete}', [PostController::class, 'delete']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/logout', [PostController::class, 'index'])->middleware('auth');

///////////////GITHUB//////////////////
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.auth');
 
Route::get('/auth/callback', function () {


    $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

               Auth::login($user);

        return redirect('/posts');
});



////////////////////GOOGLE///////////////

Route::get('/auth/redirectGoogle', function () {
    return Socialite::driver('google')->redirect();
})->name('google.auth');
 
Route::get('/auth/callbackGoogle', function () {

    $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);

               Auth::login($user);

        return redirect('/posts');
});