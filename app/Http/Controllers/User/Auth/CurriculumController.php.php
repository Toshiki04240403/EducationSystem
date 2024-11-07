<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    /**
     * 授業一覧画面の表示
     */
    public function index()
    {
        // classes_idが1（例: 1年生）の授業を取得
        $curriculums = Curriculum::where('classes_id', 1)->get();

        // ビューにデータを渡す
        return view('curriculum.index', compact('curriculums'));
    }
}
