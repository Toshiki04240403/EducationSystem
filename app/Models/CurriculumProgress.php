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
        // DBのカラム名: users_id, 参照先: Userモデルのid
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function curriculum() {
        // DBのカラム名: curriculums_id, 参照先: Curriculumモデルのid
        return $this->belongsTo(Curriculum::class, 'curriculums_id', 'id');
    }
}
