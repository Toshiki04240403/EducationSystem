<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
// プロフィール設定
    //ユーザー情報取得・表示
    public function showProfileForm() {
        $user = Auth::user();

        return view('user.profile_edit', compact('user'));
    }

    //ユーザー情報更新
    public function updateProfileForm(Request $request) {
        
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'nullable|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        DB::beginTransaction();

        try {
                $data = [
                    'name' => $request->filled('name') ? $request->input('name') : $user->name,
                    'name_kana' => $request->filled('name_kana') ? $request->input('name_kana') : $user->name_kana,
                    'email' => $request->filled('email') ? $request->input('email') : $user->email,
                ];

                if ($request->hasFile('profile_image')) {
                    $filename = $request->file('profile_image')->getClientOriginalName();
                    $img_path = $request->file('profile_image')->storeAs('public/images/profile', $filename);
                
                    if ($user && $user->profile_image) {
                        $oldImagePath = str_replace('storage/', 'public/', $user->profile_image);
                        if (Storage::exists($oldImagePath)) {
                            Storage::delete($oldImagePath);
                        }
                    }                 
                    $data['profile_image'] = 'storage/images/profile/' . $filename;
                } else {
                    $data['profile_image'] = $user->profile_image;
                }
                
            $user->updateProfile($data);

            DB::commit();
            session()->flash('success', 'プロフィールを更新しました。');
            return redirect(route('user.show.profile', $user));

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger', '更新に失敗しました: ' . $e->getMessage()); // エラーメッセージを表示
            return back();
        }
    }


// パスワード変更
    // パスワード画面表示
    public function showPasswordForm() {
            $user = Auth::user();

            return view('user.password_edit', compact('user'));
        }

     //パスワード更新
    public function updatePassword(Request $request) {

        $user = User::find(Auth::id());

        $request->validate([
            'current_password' => ['required', 'max:255', 'regex:/^[a-zA-Z0-9]+$/', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('現在のパスワードが正しくありません。');
                }                
                }],
            'new_password' => ['required', 'max:255', 'regex:/^[a-zA-Z0-9]+$/', 'confirmed'],
        ]);

        DB::beginTransaction();

        try {
            $user->updatePassword([
                'password' => Hash::make($request->new_password)
            ]);

            DB::commit();
            session()->flash('success', 'パスワードを更新しました');
            return redirect(route('user.show.password', $user));

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger', '更新に失敗しました。');
            return back();
        }
    }

}