@extends('user.layouts.app')

@section('title', 'パスワード変更')

@section('content')
<div class="container">
    <a href="{{ route('user.show.profile') }}" class="back">←戻る</a>
    <h2>パスワード変更</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('user.update.password') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">旧パスワード</label>
                <input type="password" id="form-label" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">新パスワード</label>
                <input type="password" id="form-label" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">新パスワード確認</label>
                <input type="password" id="form-label" name="new_password_confirmation" class="form-control" required>
            </div>

            <div class="form-submit">
                <button type="submit" class="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection