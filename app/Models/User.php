<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'profile_image',
    ];    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//リレーション
    public function classesClearChecks() {
        return $this->hasMany(ClassesClearCheck::class);
    }

    //public function curriculumProgress() {
        //return $this->hasMany(CurriculumProgress::class, 'users_id', 'id');
    //}

    //public function grade() {
        //return $this->belongsTo(Grade::class, 'grade_id', 'id');
    //}

// 現在の学年 (多対一)
public function grade() {
    return $this->belongsTo(Grade::class); // デフォルトでは 'grade_id' を使用
}

// ユーザーが完了した（または進捗中の）カリキュラム（多対多）
public function curriculumsProgress() {
    return $this->belongsToMany(Curriculum::class, 'curriculum_progress', 'users_id', 'curriculums_id')
                // 中間テーブルのカラムも取得可能にする
                ->withPivot('clear_flg');
}

// 完了済みのカリキュラムのみを取得するヘルパーリレーション
public function completedCurriculums() {
    return $this->curriculumsProgress()->wherePivot('clear_flg', 1);
}






    public function getProfileImageUrlAttribute() {
    return $this->profile_image ? asset('storage/images/profile/' . $this->profile_image) : asset('default-avatar.png');
    }



    public function getUser() {
    $user = Auth::user();
        if (!$user) {
            dd('ユーザーが認証されていません');
        }
    $grade = $user->grade;
    $clearFlg = $user->{'curriculumProgress'}()->value('clear_flg');

    return [
        'user' => $user,
        'grade' => $grade,
        'clearFlg' => $clearFlg ?? 0
    ];
    }

    public function getCurriculum() {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'ユーザーが認証されていません');
        }

        $currentGradeId = $user->grade_id;
    
        $curriculums = Curriculum::with(['curriculumProgress' => function($query) use ($user) {
            $query->where('users_id', $user->id);
        }])->get();
    
        return [
            'curriculums' => $curriculums,
            'currentGradeId' => $currentGradeId
        ];
    }

    public function updateProfile($data) {
        DB::table('users')
            ->where('id', $this->id)
            ->update([
                'name' => $data['name'],
                'name_kana' => $data['name_kana'],
                'email' => $data['email'],
                'profile_image' => $data['profile_image']
            ]);
    }

    public function updatePassword($data) {
        $this->update([
            'password' => $data['password'],
        ]);
    }

}