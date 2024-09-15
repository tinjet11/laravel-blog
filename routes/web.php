<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function () {
    Route::post('', [IdeaController::class, 'store'])->name('store');

    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit')->middleware('auth');

        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update')->middleware('auth');

        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy')->middleware('auth');

        //Comment
        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
    });
});

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');


Route::post('/users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('/users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::get('/user-image/{user}', [UserController::class, 'userImage'])->name('user-image.show');

Route::post('/ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('/ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->name('ideas.unlike')->middleware('auth');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');
