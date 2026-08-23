<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

//リレーション
    public function user() {
        return $this->belongsTo(User::class, 'grade_id', 'id');
    }

    public function classes_clear_checks() {
        return $this->hasMany(ClassesClearCheck::class, 'grade_id', 'id');
    }

    //public function curriculums() {
        //return $this->hasMany(Curriculum::class, 'grade_id', 'id');
    //}



    public function getGradesName() {
        $getGradesName = DB::table('grades')->get();

        return $getGradesName;
    }

    public function getGradeCurriculums() {
        $getGradeCurriculums = DB::table('grades')
            ->join('curriculums', 'grades.id', '=', 'curriculums.grade_id')
            ->select('grades.*', 'curriculums.title')
            ->get();
    
        return $getGradeCurriculums;
    }

// この学年が持つカリキュラムは何か (一対多)
public function curriculums() {
    return $this->hasMany(Curriculum::class)->orderBy('id'); // ID順で並び替え
}


}
