<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ウェルカムページ
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザー画面
Route::prefix('user')->name('user.')->group(function () {
    Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('auth/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('auth/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('auth/register', [RegisterController::class, 'register'])->name('register.post');

    Route::middleware('auth:user')->group(function () {
        Route::get('article/{id}', [UserArticleController::class, 'showArticle'])->name('show.article'); //お知らせページ

        Route::get('profile', [ProfileController::class, 'showProfileForm'])->name('show.profile'); //プロフィールページ
        Route::put('profile', [ProfileController::class, 'updateProfileForm'])->name('update.profile');

        Route::get('password', [ProfileController::class, 'showPasswordForm'])->name('show.password.edit'); //パスワード変更ページ
        Route::post('password', [ProfileController::class, 'updatePassword'])->name('update.password');

        Route::get('progress', [ProgressController::class, 'showProgress'])->name('show.progress'); //進捗ページ
    });

});

// 管理者画面
Route::middleware('auth:admin')->prefix('auth:admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list'); //管理お知らせページ
            Route::delete('article/{id}', [AdminArticleController::class, 'destroyArticle'])->name('destroy.article');

            Route::get('article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create');
            Route::post('article_create', [AdminArticleController::class, 'storeArticle'])->name('article.store'); 

            Route::get('article_edit/{id}', [AdminArticleController::class, 'showArticleEdit'])->name('show.article.edit');
            Route::put('article_update/{id}', [AdminArticleController::class, 'updateArticle'])->name('article.update');
});