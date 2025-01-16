<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">閉園時間</a></li>
                <li><a href="#">授業スケジュール</a></li>
                <li><a href="#">プロフィール設定</a></li>
            </ul>
        </nav>
        <div class="login-button">ログイン</div>
    </header>

    <main>
        <button class="back-button">戻る</button>
        <h2>プロフィール変更</h2>
        <div class="profile-image">
            <img src="profile.png" alt="プロフィール画像">
            <label for="profile-image-input">ファイルを選択</label>
            <input type="file" id="profile-image-input" style="display: none;">
        </div>
        <form>
            <label for="username">ユーザーネーム</label>
            <input type="text" id="username" name="username">

            <label for="kana">カナ</label>
            <input type="text" id="kana" name="kana">

            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email">

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password">
            <button type="button">パスワードを変更する</button>

            <button type="submit">登録</button>
        </form>
    </main>
</body>
</html>