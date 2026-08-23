<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ユーザー画面
Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('auth/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('auth/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('auth/register', [RegisterController::class, 'register'])->name('user.register.post');

    Route::get('article/{id}', [UserArticleController::class, 'showArticle'])->name('show.article'); //お知らせページ

    Route::get('profile', [ProfileController::class, 'showProfileForm'])->name('show.profile'); //プロフィールページ
    Route::put('profile', [ProfileController::class, 'updateProfileForm'])->name('update.profile');

    Route::get('password', [ProfileController::class, 'showPasswordForm'])->name('show.password.edit'); //パスワード変更ページ
    Route::post('password', [ProfileController::class, 'updatePassword'])->name('update.password');

    Route::get('progress', [ProgressController::class, 'showProgress'])->name('show.progress'); //進捗ページ
});

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list'); //管理お知らせページ

    Route::get('article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create');
});