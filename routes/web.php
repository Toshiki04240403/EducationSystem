<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Auth\CurriculumController;
use App\Http\Controllers\User\Auth\DeliveryController;
use App\Http\Controllers\User\Auth\ArticleController;
use App\Http\Controllers\User\Auth\BannerController;
use App\Http\Controllers\User\Auth\TopController;

// ウェルカムページ
Route::get('/', function () {
    return view('welcome');
});

// 認証ルート
Auth::routes();

// ホーム画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 授業関連のルート（自分の担当範囲）
Route::prefix('curriculums')->name('curriculum.')->group(function () {
    Route::get('/', [CurriculumController::class, 'index'])->name('index'); // 授業一覧画面
    Route::get('/create', [CurriculumController::class, 'create'])->name('create'); // 新規授業登録画面
    Route::post('/store', [CurriculumController::class, 'store'])->name('store'); // 新規授業登録処理
    Route::get('/{id}/edit', [CurriculumController::class, 'edit'])->name('edit'); // 授業編集画面
    Route::post('/{id}/update', [CurriculumController::class, 'update'])->name('update'); // 授業更新処理
}); 
// 配信日時設定関連ルート（curriculum 下にネスト）
Route::prefix('{curriculumId}/delivery')->name('delivery.')->group(function () {
    Route::get('create', [DeliveryController::class, 'create'])->name('create'); // 配信日時登録画面
    Route::post('store', [DeliveryController::class, 'store'])->name('store'); // 配信日時登録処理

    Route::get('{curriculumId}/delivery/edit', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::post('{deliveryId}/update', [DeliveryController::class, 'update'])->name('update'); // 配信日時更新処理
    Route::delete('{deliveryId}', [DeliveryController::class, 'destroy'])->name('destroy'); // 配信日時削除処理

   

}); 


// お知らせ管理画面（他担当者）
Route::get('/articles', [ArticleController::class, 'index'])->name('article.list'); // お知らせ管理画面

// バナー管理画面（他担当者）
Route::get('/banners', [BannerController::class, 'edit'])->name('banner.edit'); // バナー管理画面

// トップ管理画面（他担当者）
Route::get('/tops', [TopController::class, 'index'])->name('top.index'); // トップ管理画面
