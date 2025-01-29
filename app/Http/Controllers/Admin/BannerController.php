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
        
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::delete($banner->image);
            $path = $request->file('image')->store('banner');
            $banner->image = $path;
            $banner->save();
        }
        
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banner');
            Banner::create(['image' => $path]);
        }
        
    }
}