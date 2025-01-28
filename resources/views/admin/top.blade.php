<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理＿トップ</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    @include('admin.layouts.app')
    <div class="dashboard-container">
        <h2>管理者ダッシュボード</h2>
        <p>ユーザーネーム: {{ $admin->name }}</p>
        <p>メールアドレス: {{ $admin->email }}</p>
</body>
</html>