<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">時間割</a></li>
                <li><a href="#">授業進捗</a></li>
                <li><a href="#">プロフィール設定</a></li>
            </ul>
        </nav>
        <div class="login-button">ログイン</div>
    </header>

    <main>
        <button class="back-button">戻る</button>
        <h2>パスワード変更</h2>
        <form>
            <label for="old-password">旧パスワード</label>
            <input type="password" id="old-password" name="old-password">

            <label for="new-password">新しいパスワード</label>
            <input type="password" id="new-password" name="new-password">

            <label for="new-password-confirm">新しいパスワード（確認）</label>
            <input type="password" id="new-password-confirm" name="new-password-confirm">

            <button type="submit">登録</button>
        </form>
    </main>
</body>
</html>