<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Auth;

Route::get('/', [PostController::class, 'index'])->middleware('auth');
Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware('auth');
Route::get('/posts/create/', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/posts/show/{post}', [PostController::class, 'show'])->middleware('auth');
Route::get('/posts/edit/{toEdit}', [PostController::class, 'edit'])->middleware('auth');
Route::get('/posts/delete/{toDelete}', [PostController::class, 'delete'])->middleware('auth');

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