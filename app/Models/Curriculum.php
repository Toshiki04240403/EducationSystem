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
    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function usersProgress() {
        return $this->belongsToMany(User::class, 'curriculum_progress', 'curriculums_id', 'users_id')
                    ->withPivot('clear_flg'); 
    }
    
    public function curriculumProgress() {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'id');
    }
}
