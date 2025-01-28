<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\CurriculumController;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;

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


});