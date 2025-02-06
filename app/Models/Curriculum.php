<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    // テーブル名を明示
    protected $table = 'curriculums';

    // データベースから取得するカラムを指定
    protected $fillable = ['title', 'grade_id', 'delivery_from', 'delivery_to', 'thumbnail'];

    // 現在の学年と年月に一致するカリキュラムを取得するメソッド
    public static function getCurriculumsByGradeAndMonth($grade_id, $month)
    {
        return self::where('grade_id', $grade_id)
            ->whereMonth('delivery_from', $month)
            ->orWhereMonth('delivery_to', $month)
            ->get();
    }

    // リレーションの設定
    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    // Gradeとのリレーションの設定
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
