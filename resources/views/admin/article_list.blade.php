<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お知らせ一覧</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">業務管理</a></li>
                <li><a href="#">お知らせ管理</a></li>
                <li><a href="#">パートナー管理</a></li>
            </ul>
        </nav>
        <div class="login-button">ログアウト</div>
    </header>

    <main>
        <button class="back-button">戻る</button>
        <h2>お知らせ一覧</h2>
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
                    <td><button class="edit-button">変更する</button> <button class="delete-button">削除</button></td>
                </tr>
                </tbody>
        </table>
    </main>
</body>
</html>