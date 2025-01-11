<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum; // Curriculumモデルをインポート
use Carbon\Carbon; // 日付操作のためにCarbonをインポート
use App\Models\Grade;

class CurriculumController extends Controller
{
    // 時間割ページの表示
    public function showCurriculumList()
    {
        // カリキュラムのリストを取得
        $curriculums = Curriculum::all();

        // カリキュラムと関連する配信時間を取得
        $curriculums = Curriculum::with('deliveryTimes')->get();
        
       
        // gradesテーブルからデータを取得
        $grades = Grade::all();

        // ビューにデータを渡す
        return view('user.layouts.curriculum_list', compact('curriculums','grades'));
    }
}


    

