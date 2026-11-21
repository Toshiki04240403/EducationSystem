@extends('user.layouts.app')

@section('title', 'プロフィール変更')

@section('content')
<div class="container">
    <a href="#" class="back">← 戻る</a>
    <h2>プロフィール変更</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="profile-container">
                <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像">
                <div class="profile-inputs">
                    <label for="profile_image" class="profile-label">プロフィール画像</label>
                    <input type="file" id="profile_image" name="profile_image" class="hidden-form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">ユーザーネーム</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" autocomplete="name">
            </div>

            <div class="form-group">
                <label for="name_kana" class="form-label">カナ</label>
                <input type="text" id="name_kana" name="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}" autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" autocomplete="email">
            </div>

            <div class="form-password">
                <p class="form-label">パスワード</p>
                <a class="password-edit-form" href="{{ route('user.show.password.edit') }}">パスワードを変更する</a>
            </div>
            <div class="form-submit">
                <button type="submit" class="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection


{{-- {{ route('user.show.top') }}  backのURLに設定予定 --}}