<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CurriculumController extends Controller
{
    // 授業一覧表示
    public function index(Request $request)
    {
        // 学年一覧を取得
        $grades = Grade::all();

        // クエリから学年を取得（選択されていない場合は全てを取得）
        $selectedGradeId = $request->input('grade_id');

        // カリキュラムデータを取得（学年フィルタリングを適用）
        $curriculums = Curriculum::with('deliveryTimes')
            ->when($selectedGradeId, function ($query, $selectedGradeId) {
                return $query->where('grade_id', $selectedGradeId);
            })
            ->get();

        return view('user.layouts.curriculum_list', compact('curriculums', 'grades', 'selectedGradeId'));
    }

    // Ajaxリクエスト用: 学年ごとの授業リスト取得
    public function filterByGrade($gradeId)
    {
        try {
            // 指定された学年のカリキュラムデータを取得
            $curriculums = Curriculum::with('deliveryTimes')
                ->where('grade_id', $gradeId)
                ->get();

            // 必要なデータを整形してJSONで返す
            return response()->json($curriculums->map(function ($curriculum) {
                return [
                    'id' => $curriculum->id,
                    'title' => $curriculum->title ?? 'タイトル未設定',
                    'thumbnail' => $curriculum->thumbnail,
                    'delivery_from' => optional($curriculum->deliveryTimes->first())->delivery_from ?? '未設定',
                    'delivery_to' => optional($curriculum->deliveryTimes->first())->delivery_to ?? '未設定',
                ];
            }));
        } catch (\Exception $e) {
            Log::error('学年ごとの授業取得エラー: ' . $e->getMessage());
            return response()->json(['error' => 'データの取得に失敗しました。'], 500);
        }
    }

    // 新規登録ページ
    public function create()
    {
        $grades = Grade::all(); // 学年データを取得
        return view('user.layouts.curriculum_create', compact('grades'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alway_delivery_flg' => 'required|boolean',  
        ]);

        // 新しいカリキュラムのインスタンスを作成
        $curriculum = new Curriculum($request->only(['title', 'grade_id', 'description', 'video_url']));

        // alway_delivery_flg を true/false から 0/1 に変換
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg') ? 1 : 0;

        // サムネイルファイルがアップロードされている場合
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $curriculum->thumbnail = basename($path);
        }

        // データベースに保存
        $curriculum->save();

        // 成功メッセージと共にインデックスページにリダイレクト
        return redirect()->route('curriculum.index')->with('success', '新しい授業が登録されました。');
    }

    // 授業編集ページ
    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $grades = Grade::all();
        $deliveryTime = DeliveryTime::where('curriculums_id', $id)->first();  // idを使用

        return view('user.layouts.curriculum_edit', compact('curriculum', 'grades', 'deliveryTime'));
    }
    // 授業更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alway_delivery_flg' => 'nullable|boolean|in:0,1', 
        ]);

        $curriculum = Curriculum::findOrFail($id);
        $curriculum->fill($request->only(['title', 'grade_id', 'description', 'video_url']));
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg') ? 1 : 0;

        // サムネイルファイルがアップロード
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $curriculum->thumbnail = basename($path);
        }

        // データベースに保存
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', '授業が更新されました。');
    }

    // 配信日時保存処理
    public function saveDeliveryTime(Request $request, $curriculumId)
    {
        $validatedData = $request->validate([
            'delivery_from_date' => 'required|date|before_or_equal:delivery_to_date',
            'delivery_from_time' => 'required|date_format:H:i',
            'delivery_to_date'   => 'required|date|after_or_equal:delivery_from_date',
            'delivery_to_time'   => 'required|date_format:H:i',
        ]);

        $deliveryFrom = $validatedData['delivery_from_date'] . ' ' . $validatedData['delivery_from_time'];
        $deliveryTo = $validatedData['delivery_to_date'] . ' ' . $validatedData['delivery_to_time'];

        try {
            $curriculum = Curriculum::findOrFail($curriculumId);

            DeliveryTime::updateOrCreate(
                ['curriculums_id' => $curriculumId], // 外部キーとしてcurriculums_idを使用
                ['delivery_from' => $deliveryFrom, 'delivery_to' => $deliveryTo]
            );

            return redirect()->route('curriculum.edit', $curriculumId)->with('success', '配信日時が保存されました。');
        } catch (\Exception $e) {
            Log::error('配信日時保存エラー: ' . $e->getMessage());

            return redirect()->route('curriculum.edit', $curriculumId)->with('error', '配信日時の保存に失敗しました。');
        }
    }
}
