@extends('admin.layouts.app')

@section('title', 'お知らせ新規登録')

@section('content')
  <main>
    <div class="container">

      <a href="" class="back">戻る</a>
      <h1>お知らせ変更</h1>

      <div class="">
        <form method="POST">
          <label for="post_date">投稿日時</label>
          <input type="text" id="post_date" name="post_date">

          <label for="title">タイトル</label>
          <input type="text" id="title" name="title">

          <label for="body">本文</label>
          <textarea id="body" name="body"></textarea>

          <button type="submit">登録</button>
        </form>
      </div>

    </div>
  </main>
@endsection