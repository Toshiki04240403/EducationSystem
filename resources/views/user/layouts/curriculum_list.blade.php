@extends('layouts.app')

@section('title', '授業一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<header>
    <div class="container">
        <div class="management-buttons d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('curriculum.index') }}" class="btn btn-info me-2">授業管理</a>
                <a href="{{ route('article.list') }}" class="btn btn-primary me-2">お知らせ管理</a>
                <a href="{{ route('banner.edit') }}" class="btn btn-success me-2">バナー管理</a>
            </div>
            <a href="{{ route('logout') }}" 
               class="btn btn-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
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

    <!-- 学年選択 -->
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <h3 class="mb-3">学年選択</h3>
                @foreach ($grades as $grade)
                    <button type="button" 
                            class="btn btn-outline-info btn-block grade-button mb-2" 
                            style="width: 100%;" 
                            data-grade="{{ $grade->id }}">
                        {{ $grade->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="col-md-9">
            <div id="class-list" class="row">
                <!-- 授業一覧 -->
                @foreach ($curriculums->slice(0, 6) as $curriculum)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $curriculum->thumbnail 
                                       ? asset('storage/thumbnails/' . $curriculum->thumbnail) 
                                       : asset('images/default-thumbnail.png') }}" 
                                 alt="授業サムネイル" 
                                 class="card-img-top" 
                                 style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h4 class="card-title">{{ $curriculum->title ?? 'タイトル未設定' }}</h4>
                                <!-- 配信日時表示 -->
                                @if ($curriculum->deliveryTimes->isNotEmpty())
                                    @foreach ($curriculum->deliveryTimes as $deliveryTime)
                                        <p class="card-text">
                                            配信日時: 
                                            {{ date('Y年m月d日 H:i', strtotime($deliveryTime->delivery_from)) }} 〜 
                                            {{ date('Y年m月d日 H:i', strtotime($deliveryTime->delivery_to)) }}
                                        </p>
                                    @endforeach
                                @else
                                    <p class="card-text">配信日時: 未設定</p>
                                @endif
                                <div class="text-center">
                                    <!-- 授業内容編集ボタン -->
                                    <a href="{{ route('curriculum.edit', ['id' => $curriculum->id]) }}" 
                                       class="btn btn-info btn-sm mt-2">
                                        授業内容編集
                                    </a>

                                    <!-- 配信日時編集ボタン -->
                                    <a href="{{ route('delivery.edit', ['curriculumId' => $curriculum->id]) }}" 
                                       class="btn btn-secondary btn-sm mt-2">
                                        配信日時編集
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.grade-button', function () {
    const grade = $(this).data('grade'); // ボタンに埋め込まれた学年データを取得
    console.log('選択された学年:', grade);

    // 非同期リクエスト
    $.ajax({
        url: `/grades/${grade}`, // LaravelのルートURLを呼び出す
        method: 'GET',
        success: function (data) {
            const $classList = $('#class-list');
            $classList.empty(); // 現在の内容をクリア

            if (!data || data.length === 0) {
                $classList.append('<p>該当する授業がありません。</p>');
            } else {
                data.forEach(function (item) {
                    const thumbnail = item.thumbnail 
                                      ? `/storage/thumbnails/${item.thumbnail}` 
                                      : '/images/default-thumbnail.png';
                    const deliveryFrom = item.delivery_from || '未設定';
                    const deliveryTo = item.delivery_to || '未設定';

                    const card = `
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="${thumbnail}" 
                                     alt="授業画像" 
                                     class="card-img-top" 
                                     style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h4 class="card-title">${item.title || 'タイトル未設定'}</h4>
                                    <p class="card-text">
                                        配信日時: ${deliveryFrom} 〜 ${deliveryTo}
                                    </p>
                                    <a href="/curriculums/curriculum/${item.id}/edit" 
                                       class="btn btn-info btn-sm">
                                       授業内容編集
                                    </a>
                                    <a href="/curriculums/${item.id}/delivery/edit" 
                                       class="btn btn-secondary btn-sm mt-2">
                                       配信日時編集
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    $classList.append(card);
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('エラー詳細:', error);
            alert('データの取得に失敗しました。サーバー側で問題が発生している可能性があります。');
        }
    });
});
</script>
