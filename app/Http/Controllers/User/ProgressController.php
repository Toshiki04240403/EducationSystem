<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;
use App\Models\CurriculumProgress;
use App\Models\Curriculum;

class ProgressController extends Controller
{
    public function showProgress() {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'ユーザーが認証されていません');
        }

        $userGrade = $user->grade;
        $grades = Grade::with('curriculums.curriculumProgress')->orderBy('id')->get();
    
        $isPreviousGradeCompleted = true; 
    
        foreach ($grades as $grade) {
        
            $grade->is_available = $isPreviousGradeCompleted;
        
            $isGradeCompleted = true; 
        
            foreach ($grade->curriculums as $curriculum) {
            
                $progress = $curriculum->curriculumProgress->firstWhere('users_id', $user->id); 
                $curriculum->clearFlg = $progress ? $progress->clear_flg == 1 : false;

                $curriculum->isDisabled = !$grade->is_available; 

                if (!$curriculum->clearFlg) {
                    $isGradeCompleted = false;
                }
            }
            $isPreviousGradeCompleted = $grade->is_available && $isGradeCompleted;
        }
        return view('user.curriculum_progress', compact('user', 'userGrade', 'grades'));
    }
}
