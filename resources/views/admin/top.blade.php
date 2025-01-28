<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理＿トップ</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <topheader>
        
                <a href="{{ route('admin.index') }}" class="btn topbtn">授業管理</a>
                <a href="/admin/users" class="btn topbtn">お知らせ管理</a>
                <a href="/admin/settings" class="btn topbtn">バナー管理</a>
                <a href="/logout" class="btn topbtn-logout">ログアウト</a>
    </topheader>
    <main>
        <p>ユーザーネーム：</p>
        <p>メールアドレス：</p>
    </main>
</body>
</html>