<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    // 管理者トップページの表示
    public function ShowTop()
    {
        return view('admin.top');
    }
}
