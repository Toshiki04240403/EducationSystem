@extends('admin.layouts.app')

@section('content')
<header>
    <div class="container">
        <div class="management-buttons d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('admin.curriculum.index') }}" class="btn btn-info me-2">授業管理</a>
                <a href="{{ route('admin.article.list') }}" class="btn btn-primary me-2">お知らせ管理</a>
                <a href="{{ route('admin.banner.edit') }}" class="btn btn-success me-2">バナー管理</a>
            </div>
            <a href="{{ route('logout') }}" class="btn btn-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        </div>
    </div>
</header>

<div class="container">
    <h2>授業設定</h2>
    <a href="{{ route('admin.curriculum.index') }}" class="btn btn-link">&lt; 戻る</a>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

    <!-- 成功メッセージ -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- エラーメッセージ -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($curriculum) ? route('admin.curriculum.update', $curriculum->id) : route('admin.curriculum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($curriculum))
            @method('PUT')
        @endif

        <!-- サムネイル -->
<div class="form-group mt-4">
    <label for="thumbnail">サムネイル</label>
    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
    @if(isset($curriculum->thumbnail))
        <div class="mt-2">
            <img src="{{ asset('storage/thumbnails/' . $curriculum->thumbnail) }}" alt="サムネイル" class="img-thumbnail" style="width: 200px;">
        </div>
    @endif
</div>


        <!-- 学年選択 -->
        <div class="form-group mt-3">
            <label for="grade">学年</label>
            <select name="grade_id" id="grade" class="form-control" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" 
                        {{ (isset($curriculum) && $curriculum->grade_id == $grade->id) ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 授業名 -->
        <div class="form-group mt-3">
            <label for="title">授業名</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $curriculum->title ?? '') }}" required>
        </div>

        <!-- 動画URL -->
        <div class="form-group mt-3">
            <label for="video_url">動画URL</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url', $curriculum->video_url ?? '') }}">
        </div>

        <!-- 授業概要 -->
        <div class="form-group mt-3">
            <label for="description">授業概要</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $curriculum->description ?? '') }}</textarea>
        </div>

       <!-- 常時公開 -->
       <div class="form-check mt-3">
       <input type="checkbox" name="alway_delivery_flg" id="alway_delivery_flg" class="form-check-input"
    value="1" {{ (old('alway_delivery_flg') ?? $curriculum->alway_delivery_flg ?? 0) == 1 ? 'checked' : '' }}>
<label for="alway_delivery_flg" class="form-check-label">常時公開</label>

        <!-- 登録ボタン -->
        <button type="submit" class="btn btn-primary mt-3">登録</button>
    </form>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection
