<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\CurriculumController;
use App\Http\Controllers\Admin\Auth\DeliveryController;
use App\Http\Controllers\Admin\Auth\ArticleController;
use App\Http\Controllers\Admin\Auth\BannerController;
use App\Http\Controllers\Admin\Auth\TopController;

// ウェルカムページ
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

// 管理者画面
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list'); //管理お知らせページ
    Route::delete('/admin/article/{id}', [AdminArticleController::class, 'destroyArticle'])->name('destroy.article');

    Route::get('article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create');
});
// 認証ルート
Auth::routes();

// ホーム画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 管理者用のルート設定
Route::prefix('admin')->name('admin.')->group(function () {
    // 授業関連のルート
    Route::prefix('curriculums')->name('curriculum.')->group(function () {
        Route::get('/', [CurriculumController::class, 'index'])->name('index');          // 授業一覧画面
        Route::get('/create', [CurriculumController::class, 'create'])->name('create');  // 新規授業登録画面
        Route::post('/store', [CurriculumController::class, 'store'])->name('store');    // 新規授業登録処理
        Route::get('/{id}/edit', [CurriculumController::class, 'edit'])->name('edit');   // 授業編集画面
        Route::put('/{id}/update', [CurriculumController::class, 'update'])->name('update'); // 授業更新処理
    });

    // 配信関連のルート
    Route::prefix('curriculums/{curriculumId}/delivery')->name('delivery.')->group(function () {
        Route::get('/edit', [DeliveryController::class, 'edit'])->name('edit');          // 編集画面表示
        Route::get('/create', [DeliveryController::class, 'create'])->name('create');    // 新規作成画面
        Route::post('/store', [DeliveryController::class, 'store'])->name('store');      // 新規配信日時登録
        Route::put('/update', [DeliveryController::class, 'update'])->name('update');    // 配信日時保存処理
        Route::delete('/{deliveryId}', [DeliveryController::class, 'destroy'])->name('destroy'); // 削除処理
    });

    // 学年データ取得API
    Route::get('/grades/{gradeId}', [CurriculumController::class, 'filterByGrade'])->name('grades.filter');

    // お知らせ管理画面
    Route::get('/articles', [ArticleController::class, 'index'])->name('article.list'); // お知らせ管理画面

    // バナー管理画面
    Route::get('/banners', [BannerController::class, 'edit'])->name('banner.edit');     // バナー管理画面

    // トップ管理画面
    Route::get('/tops', [TopController::class, 'index'])->name('top.index');            // トップ管理画面
});
