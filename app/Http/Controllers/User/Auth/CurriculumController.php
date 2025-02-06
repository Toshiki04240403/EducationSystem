<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Carbon\Carbon;
use App\Models\Grade;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Show the curriculum list.
     *
     * @return \Illuminate\View\
     */
    public function showCurriculumList()
    {
        $currentDateTime = Carbon::now();

        $grades = Grade::all();

        $curriculums = Curriculum::with(['deliveryTimes' => function ($query) use ($currentDateTime) {
            $query->where(function ($query) use ($currentDateTime) {
                $query->where('delivery_from', '<=', $currentDateTime)
                      ->where('delivery_to', '>=', $currentDateTime);
            });
        }])->where(function ($query) use ($currentDateTime) {
            $query->where('alway_delivery_flg', 1)
                  ->orWhere(function ($query) use ($currentDateTime) {
                      $query->where('alway_delivery_flg', 0)
                            ->whereHas('deliveryTimes', function ($query) use ($currentDateTime) {
                                $query->where('delivery_from', '<=', $currentDateTime)
                                      ->where('delivery_to', '>=', $currentDateTime);
                            });
                  });
        })->get();

        return view('user.layouts.curriculum_list', compact('curriculums','grades'));
    }
}