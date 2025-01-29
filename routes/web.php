<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\CurriculumController;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\BannerController;

// ユーザー用のルートをグループ化
Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    // カリキュラムリストへのルート
    Route::get('/curriculums_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
});
// 管理者用のルートをグループ化
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/top', [TopController::class, 'index'])->name('index');
    // 他の管理者用ルートをここに追加できます
});


// /topへのルートを追加
Route::get('/top', [TopController::class, 'ShowTop'])->name('show.top');
Route::get('/curriculums_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');


Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('top', [TopController::class, 'showTop'])->name('show.top')->middleware('auth:admin');
    Route::get('curriclum_list', [CurriculumController::class, 'showCurriclumList'])->name('admin.curriclum.list')->middleware('auth:admin');
    Route::get('article_list', [ArticleController::class, 'showArticleList'])->name('admin.article.list')->middleware('auth:admin');
    Route::get('banners_edit', [BannerController::class, 'showBannerEdit'])->name('admin.banner.edit')->middleware('auth:admin');
    Route::delete('banners/{id}', [BannerController::class, 'delete'])->name('admin.banners.delete')->middleware('auth:admin');
    Route::put('banners/{id}', [BannerController::class, 'update'])->name('admin.banners.update')->middleware('auth:admin');
    Route::post('banners', [BannerController::class, 'store'])->name('admin.banners.store')->middleware('auth:admin');




});