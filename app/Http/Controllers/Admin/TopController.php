<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TopController extends Controller
{
    // 管理者トップページの表示
    public function index()
    {
        return view('admin.layouts.top');
    }
}
