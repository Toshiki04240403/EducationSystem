<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = ['title', 'grade_id'];


//リレーション
    //public function grade(){
        //return $this->belongsTo(Grade::class, 'grade_id', 'id');
    //}

    //public function curriculumProgress() {
        //return $this->hasmany(CurriculumProgress::class, 'curriculums_id', 'id');
    //}


    public function grade() {
        return $this->belongsTo(Grade::class); // デフォルトでは 'grade_id' を使用
    }

    // このカリキュラムを完了したユーザーは誰か (多対多)
    // 中間テーブル名は 'curriculum_progress'
    public function usersProgress() {
        return $this->belongsToMany(User::class, 'curriculum_progress', 'curriculums_id', 'users_id')
                    // 中間テーブルのカラムも取得可能にする
                    ->withPivot('clear_flg'); 
    }
    
    // コントローラーの既存コードで使われているリレーション名に合わせる
    public function curriculumProgress() {
        // CurriculumProgress モデルへの一対多のリレーションを定義
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'id');
    }








}
