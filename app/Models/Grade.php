<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    // テーブル名を指定（必要に応じて）
    protected $table = 'grades';

    // マスアサインメント可能な属性
    protected $fillable = ['name'];
    // Curriculumとのリレーションの設定
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }
}
