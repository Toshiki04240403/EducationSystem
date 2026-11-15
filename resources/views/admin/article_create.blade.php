@extends('admin.layouts.app')

@section('title', isset($article) ? 'お知らせ編集' : 'お知らせ新規登録')

@section('content')
  <main>
    <div class="container">

      <a href="{{ route('admin.show.article.list') }}" class="back">← 戻る</a>
      <div class="news_edit">
        <h1>{{ isset($article) ? 'お知らせ編集' : 'お知らせ新規登録' }}</h1>
      </div>

      <div class="">
        <form action="{{ isset($article) ? route('admin.article.update', $article->id) : route('admin.article.store') }}" method="POST">
          @csrf
          @if(isset($article))
              @method('PUT') {{-- 編集のときは PUT メソッドに変更 --}}
          @endif

            <div class="post_date">
              <label for="posted_date">投稿日時</label>
              <input type="text" id="posted_date" name="posted_date" value="{{ old('posted_date', $article->posted_date ?? '') }}">
            </div>

            <div class="title">
              <label for="title">タイトル</label>
              <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}">
            </div>

            <div class="body">
              <label for="article_contents">本文</label>
              <textarea id="article_contents" name="article_contents">{{ old('article_contents', $article->article_contents ?? '') }}</textarea>
            </div>

            <div>
              <button class="register_button" type="submit">{{ isset($article) ? '更新する' : '登録する' }}</button>
            </div>
        </form>
      </div>

    </div>
  </main>
@endsection