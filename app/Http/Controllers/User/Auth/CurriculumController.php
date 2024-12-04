<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{
    public function index(Request $request)
{
    $grade = $request->input('grade'); // リクエストから学年を取得

    $curriculums = Curriculum::with('deliveryTimes') // deliveryTimesリレーションをプリロード
        ->when($grade, function ($query, $grade) {
            return $query->where('grade_id', $grade);
        })
        ->get();

    $selectedGrade = $grade; // 現在の学年を保持

    return view('user.layouts.curriculum_list', compact('curriculums', 'selectedGrade'));
}


    // 新規登録ページの表示
    public function create()
    {
        $grades = Grade::all(); // 学年データを全件取得

        return view('user.layouts.curriculum_create', compact('grades'));
    }

    // 授業編集ページの表示
    public function edit($curriculumId)
    {
        $curriculum = Curriculum::findOrFail($curriculumId);
        $deliveryTime = DeliveryTime::where('curriculums_id', $curriculumId)->firstOrFail(); // 最初の配信日時を取得
    
        return view('user.layouts.delivery_edit', compact('curriculum', 'delivery_times'));
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
            'alway_delivery_flg' => 'nullable|boolean',
        ]);

        $curriculum = new Curriculum($request->only(['title', 'grade_id', 'description', 'video_url']));
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $curriculum->thumbnail = basename($path);
        }

        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', '新しい授業が登録されました。');
    }

    // 授業データの更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alway_delivery_flg' => 'nullable|boolean',
        ]);

        $curriculum = Curriculum::findOrFail($id);
        $curriculum->fill($request->only(['title', 'grade_id', 'description', 'video_url']));
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $curriculum->thumbnail = basename($path);
        }

        $curriculum->save();

        return redirect()->route('curriculum.index')->with('success', '授業が更新されました。');
    }

    // 配信日時保存処理
    public function saveDeliveryTime(Request $request, $curriculumId)
    {
        $request->validate([
            'delivery_from_date' => 'required|date',            // 配信開始日
            'delivery_from_time' => 'required|date_format:H:i', // 配信開始時間
            'delivery_to_date'   => 'required|date|after_or_equal:delivery_from_date', // 配信終了日
            'delivery_to_time'   => 'required|date_format:H:i', // 配信終了時間
        ]);

        $curriculum = Curriculum::findOrFail($curriculumId); // curriculum_id の存在を確認

        $deliveryFrom = $request->input('delivery_from_date') . ' ' . $request->input('delivery_from_time');
        $deliveryTo = $request->input('delivery_to_date') . ' ' . $request->input('delivery_to_time');

        $deliveryTime = new DeliveryTime();
        $deliveryTime->curriculum_id = $curriculumId; // 外部キーに対応
        $deliveryTime->delivery_from = $deliveryFrom;
        $deliveryTime->delivery_to = $deliveryTo;

        try {
            $deliveryTime->save();

            return redirect()->route('curriculum.edit', $curriculumId)->with('success', '配信日時が保存されました。');
        } catch (\Exception $e) {
            return redirect()->route('curriculum.edit', $curriculumId)->with('error', '配信日時の保存に失敗しました。');
        }
    }
}
