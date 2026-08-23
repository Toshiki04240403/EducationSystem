@extends('user.layouts.app')

@section('title', 'ユーザーお知らせ')

@section('content')
    <main>
        <div class="container">
            <a href="#" class="back">← 戻る</a>
            <div class="article-container">
                <p class="article-date">{{ $article->formatted_posted_date }}</p>
                <h1 class="article-title">{{ $article->title }}</h1>
                <p class="article-text">{{ $article->article_contents }}</p>
            </div>
        </div>
    </main>
@endsection