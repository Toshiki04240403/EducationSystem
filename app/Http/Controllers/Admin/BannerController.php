<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function showBannerEdit()
    {
        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::delete($banner->image);
        $banner->delete();
        return redirect()->route('admin.banner.edit')->with('success', 'バナーが削除されました');
    }

    

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners/image');
            Banner::create(['image' => $path]);
        }
        return redirect()->route('admin.banner.edit')->with('success', 'バナーが追加されました');
    }
}