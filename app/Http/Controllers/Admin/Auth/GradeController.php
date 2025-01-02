<?php
namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculum; // カリキュラムモデルを追加
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    /**
     * 学年に紐づく授業データを取得する
     */
    public function getGradeClasses($gradeName)
    {
        try {
            // URLデコード（日本語名対応）
            $decodedGradeName = urldecode($gradeName);

            // 学年データを取得
            $grade = Grade::where('name', $decodedGradeName)->first();

            if (!$grade) {
                // 学年が見つからない場合
                return response()->json(['message' => '該当する学年が見つかりません。'], 404);
            }

            // 学年に紐づくカリキュラムを取得
            $curriculums = Curriculum::where('grade_id', $grade->id)
                ->get(['id', 'title', 'description', 'thumbnail', 'delivery_from', 'delivery_to']);

            if ($curriculums->isEmpty()) {
                // カリキュラムが存在しない場合
                return response()->json(['message' => '該当する授業がありません。'], 200);
            }

            // 授業データをJSON形式で返却
            return response()->json($curriculums, 200);

        } catch (\Exception $e) {
            // エラーログに記録
            Log::error('学年データ取得エラー: ' . $e->getMessage());
            return response()->json(['message' => 'サーバーエラーが発生しました。'], 500);
        }
    }
}
