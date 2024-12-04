@extends('layouts.app')

@section('content')
<header>
    <div class="container">
        <div class="management-buttons d-flex mb-4">
            <a href="{{ route('curriculum.index') }}" class="btn btn-info mr-2">授業管理</a>
            <a href="{{ route('article.list') }}" class="btn btn-primary mr-2">お知らせ管理</a>
            <a href="{{ route('banner.edit') }}" class="btn btn-success mr-2">バナー管理</a>
            <a href="{{ route('top.index') }}" class="btn btn-success">ログアウト</a>
        </div>
    </div>
</header>

<div class="container">
    <h2>授業設定</h2>
    <a href="{{ route('curriculum.index') }}" class="btn btn-link">&lt; 戻る</a>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

    <form action="{{ isset($curriculum) ? route('curriculum.update', $curriculum->id) : route('curriculum.store') }}" method="POST" enctype="multipart/form-data">
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
                    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="サムネイル" class="img-thumbnail" style="width: 200px;">
                </div>
            @endif
        </div>

        <!-- 学年選択 -->
        <div class="form-group mt-3">
            <label for="grade">学年</label>
            <select name="grade_id" id="grade" class="form-control">
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
            <input type="text" name="title" id="title" class="form-control" value="{{ $curriculum->title ?? '' }}" required>
        </div>

        <!-- 動画URL -->
        <div class="form-group mt-3">
            <label for="video_url">動画URL</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ $curriculum->video_url ?? '' }}">
        </div>

        <!-- 授業概要 -->
        <div class="form-group mt-3">
            <label for="description">授業概要</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $curriculum->description ?? '' }}</textarea>
        </div>

        <!-- 常時公開 -->
        <div class="form-check mt-3">
            <input type="checkbox" name="alway_delivery_flg" id="alway_delivery_flg" class="form-check-input" 
                {{ isset($curriculum->alway_delivery_flg) && $curriculum->alway_delivery_flg ? 'checked' : '' }}>
            <label for="alway_delivery_flg" class="form-check-label">常時公開</label>
        </div>

        <!-- 登録ボタン -->
        <button type="submit" class="btn btn-primary mt-3">登録</button>
    </form>
</div>
@endsection
