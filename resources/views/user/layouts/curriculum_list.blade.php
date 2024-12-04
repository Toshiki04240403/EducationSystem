@extends('layouts.app')

@section('title', '授業一覧')

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
    <!-- 戻るリンク -->
    <div class="back-link mb-4">
        <a href="{{ route('curriculum.index') }}" class="btn btn-link">← 戻る</a>
    </div>

    <!-- タイトル -->
    <h1 class="mb-4">授業一覧</h1>

    <!-- 新規登録ボタン -->
    <div class="new-registration mb-4">
        <a href="{{ route('curriculum.create') }}" class="btn btn-info">新規登録</a>
    </div>

    <!-- 現在の学年表示 -->
    <div class="selected-grade mb-4 text-center">
        <span class="badge badge-primary p-3">
            {{ $selectedGrade ?? '学年未選択' }}
        </span>
    </div>

    <div class="row">
        <!-- サイドバー -->
        <div class="col-md-3">
            <div class="sidebar">
                <h3 class="mb-3">学年選択</h3>

                <!-- 学年リストを取得 -->
                @php
                    $grades = [
                        '小学校1年生', '小学校2年生', '小学校3年生', 
                        '小学校4年生', '小学校5年生', '小学校6年生', 
                        '中学校1年生', '中学校2年生', '中学校3年生', 
                        '高校1年生', '高校2年生', '高校3年生'
                    ];
                @endphp

                <!-- 学年選択フォーム -->
                @foreach ($grades as $grade)
                    <form method="GET" action="{{ route('curriculum.index') }}" class="mb-2">
                        <input type="hidden" name="grade" value="{{ $grade }}">
                        <button type="submit" class="btn btn-outline-info btn-block">
                            {{ $grade }}
                        </button>
                    </form>
                @endforeach
            </div>
        </div>

        <!-- コンテンツ -->
        @foreach ($curriculums as $curriculum)
    <div class="col-md-4 mb-4">
        <div class="card">
            <!-- サムネイル画像 -->
            <img 
                src="{{ $curriculum->thumbnail ? asset('storage/thumbnails/' . $curriculum->thumbnail) : asset('images/default-thumbnail.png') }}" 
                alt="授業サムネイル" 
                class="card-img-top" 
                style="height: 150px; object-fit: cover;">

            <div class="card-body">
                <!-- タイトル -->
                <h4 class="card-title">{{ $curriculum->title ?? 'タイトル未設定' }}</h4>

                <!-- スケジュールの表示 -->
                @if($curriculum->deliveryTimes->isEmpty())
                    <p class="card-text">スケジュールが登録されていません。</p>
                @else
                    <p class="card-text">
                        @foreach ($curriculum->deliveryTimes as $deliveryTime)
                            {{ $deliveryTime->delivery_from ?? '未設定' }} ～ 
                            {{ $deliveryTime->delivery_to ?? '未設定' }} <br>
                        @endforeach
                    </p>
                @endif

                <!-- ボタン -->
                <div class="text-center">
                    <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="btn btn-info btn-sm">
                        授業内容編集
                    </a>
                    <!-- 配信日時編集ボタンを表示するために、各配信日時のIDを使用 -->
                    @foreach ($curriculum->deliveryTimes as $deliveryTime)
                        <a href="{{ route('delivery.edit', ['curriculumId' => $curriculum->id, 'deliveryId' => $deliveryTime->id]) }}" class="btn btn-info btn-sm">
                            配信日時編集
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach
