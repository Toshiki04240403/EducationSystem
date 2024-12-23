<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    // 配信日時編集フォームの表示
    public function edit($curriculumId)
    {
        try {
            // カリキュラムを取得
            $curriculum = Curriculum::findOrFail($curriculumId);

            // カリキュラムに関連する配信日時を取得
            $deliveryTimes = $curriculum->deliveryTimes;

            // ビューに渡す
            return view('user.layouts.delivery', compact('curriculum', 'deliveryTimes'));
        } catch (\Exception $e) {
            Log::error('配信日時編集フォームの取得に失敗しました: ', ['error' => $e->getMessage()]);
            return redirect()
                ->route('curriculum.index')
                ->with('error', 'カリキュラム情報の取得に失敗しました。');
        }
    }

    // 配信日時の保存
    public function store(Request $request, $curriculumId)
    {
        $request->validate([
            'delivery_times' => 'required|array|min:1', // 配信日時は1件以上必要
            'delivery_times.*.from_date' => 'required|date',
            'delivery_times.*.from_time' => 'required|date_format:H:i',
            'delivery_times.*.to_date'   => 'required|date|after_or_equal:delivery_times.*.from_date',
            'delivery_times.*.to_time'   => 'required|date_format:H:i',
        ]);

        try {
            DB::transaction(function () use ($request, $curriculumId) {
                foreach ($request->input('delivery_times') as $time) {
                    DeliveryTime::create([
                        'curriculums_id' => $curriculumId,
                        'delivery_from' => $time['from_date'] . ' ' . $time['from_time'],
                        'delivery_to'   => $time['to_date'] . ' ' . $time['to_time'],
                    ]);
                }
            });

            return redirect()->route('curriculum.index')->with('success', '新しい配信日時が登録されました。');
        } catch (\Exception $e) {
            Log::error('新しい配信日時の登録に失敗しました: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', '配信日時の登録に失敗しました。再度お試しください。');
        }
    }

    // 配信日時の更新
    public function update(Request $request, $curriculumId, $deliveryId)
    {
        $request->validate([
            'delivery_times' => 'required|array|min:1', // 配信日時は1件以上必要
            'delivery_times.*.from_date' => 'required|date',
            'delivery_times.*.from_time' => 'required|date_format:H:i',
            'delivery_times.*.to_date'   => 'required|date|after_or_equal:delivery_times.*.from_date',
            'delivery_times.*.to_time'   => 'required|date_format:H:i',
        ]);

        try {
            DB::transaction(function () use ($request, $curriculumId, $deliveryId) {
                // 既存の配信日時を取得して削除
                $deliveryTime = DeliveryTime::findOrFail($deliveryId);
                $deliveryTime->delete();

                // 新しい配信日時を保存
                foreach ($request->input('delivery_times') as $time) {
                    DeliveryTime::create([
                        'curriculums_id' => $curriculumId,
                        'delivery_from' => $time['from_date'] . ' ' . $time['from_time'],
                        'delivery_to'   => $time['to_date'] . ' ' . $time['to_time'],
                    ]);
                }
            });

            return redirect()->route('curriculum.index')->with('success', '配信日時が更新されました。');
        } catch (\Exception $e) {
            Log::error('配信日時の更新に失敗しました: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', '配信日時の更新に失敗しました。再度お試しください。');
        }
    }
}
