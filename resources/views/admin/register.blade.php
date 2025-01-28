<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="register-container">
        <p><a href="{{ route('admin.login') }}">ログインはこちら</a>
        <h2>新規管理ユーザー登録</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>空欄があります全て埋めてください</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="form-group">
                <label for="name">ユーザーネーム</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="kana">カナ</label>
                <input type="text" id="kana" name="kana" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
        
    </div>
</body>
</html>