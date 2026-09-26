@extends('admin.layouts.app')

@section('title', 'お知らせ一覧')

@section('content')
    <main>
        <div class="container">
            <a href="" class="back">← 戻る</a>
            <div class="news_list">
                <h1>お知らせ一覧</h1>
                <a href="{{ route('admin.show.article.create') }}" class="create_button">新規登録</a>
            </div>

            <table class="news-table">
                <thead>
                    <tr>
                        <th class="col-date">投稿日時</th>
                        <th class="col-title">タイトル</th>
                        <th class="col-actions"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td class="col-date">{{ $article->formatted_posted_date }}</td>
                        <td class="col-title">{{ $article->title }}</td>
                        <td class="col-actions">
                            <button class="edit-button">変更する</button>
                            <form action="{{ route('admin.destroy.article', $article->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="delete-button">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
@endsection