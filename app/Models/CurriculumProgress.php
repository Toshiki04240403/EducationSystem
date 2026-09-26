<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    protected $fillable = ['users_id', 'clear_flg'];

//リレーション
    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function curriculum() {
        return $this->belongsTo(Curriculum::class, 'curriculums_id', 'id');
    }
}
