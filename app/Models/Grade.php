<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // テーブル名を指定（省略可能、テーブル名が複数形の規則に従っていない場合のみ必要）
    protected $table = 'grades';

    // 許可するフィルター可能なカラム（ホワイトリスト方式）
    protected $fillable = [
        'name', // 学年名（例: 1年生、2年生など）
    ];

    // 他のモデルとのリレーションがあれば、ここに定義
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }
}
