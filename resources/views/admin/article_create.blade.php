@extends('admin.layouts.app')

@section('title', 'お知らせ新規登録')

@section('content')
  <main>
    <div class="container">

      <a href="{{ route('admin.show.article.list') }}" class="back">← 戻る</a>
      <div class="news_edit">
        <h1>お知らせ変更</h1>
      </div>

      <div class="">
        <form method="POST">
          <div class="post_date">
            <label for="post_date">投稿日時</label>
            <input type="text" id="post_date" name="post_date">
          </div>

          <div class="title">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title">
          </div>

          <div class="body">
            <label for="body">本文</label>
            <textarea id="body" name="body"></textarea>
          </div>

          <div>
            <button class="register_button" type="submit">登録</button>
          </div>
        </form>
      </div>

    </div>
  </main>
@endsection