<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\CurriculumController;


// カリキュラムリストへのルート
Route::get('/curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
