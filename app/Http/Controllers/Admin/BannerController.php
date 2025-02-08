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

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::delete($banner->image);
            $path = $request->file('image')->store('public/banners/image');
            $banner->image = str_replace('public/', '', $path); // パスを修正
            $banner->save();
        }
        return redirect()->route('admin.banner.edit')->with('success', 'バナーが更新されました');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/banners');
                Banner::create(['image' => str_replace('public/', '', $path)]); // パスを修正
            }
        }

        return redirect()->route('admin.banner.edit')->with('success', 'バナーが追加されました');
    }
}