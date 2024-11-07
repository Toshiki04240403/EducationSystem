<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Curriculum extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 'curriculums';

    // 編集可能なカラムの指定
    protected $fillable = [
        'title',                 // 授業タイトル
        'thumbnail',             // サムネイル画像パス
        'alway_delivery_flag',   // 常時配信フラグ (0: 非配信, 1: 配信)
        'classes_id'             // クラスID（学年やクラスを識別するため）
    ];

    // クラスのリレーション（もしclassesテーブルがある場合）
    public function class()
    {
        return $this->belongsTo(Class::class, 'classes_id');
    }
}
