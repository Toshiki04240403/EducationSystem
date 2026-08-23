@extends('admin.layouts.app')

@section('title', 'お知らせ変更')

@section('content')
    <main>
        <div class="container">
            <a href="" class="back">←戻る</a>
            <div class="">
                <h1>お知らせ一覧</h1>
                <button class="creat_button">新規登録</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>投稿日時</th>
                        <th>タイトル</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023年7月21日</td>
                        <td>授業内容変更についてのお知らせ</td>
                        <td>
                            <button class="edit-button">変更する</button> 
                            <button class="delete-button">削除</button>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </main>
</body>
@endsection