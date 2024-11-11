<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum; // Curriculumモデルをインポート
use Carbon\Carbon; // 日付操作のためにCarbonをインポート

class CurriculumController extends Controller
{
    // 時間割ページの表示
    public function index()
    {
        // カリキュラムのリストを取得
        $curriculums = Curriculum::all();
        
        // ビューにデータを渡す
        return view('user.layouts.curriculum_list', compact('curriculums'));
    }
}
