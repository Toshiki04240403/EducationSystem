<!-- resources/views/user/layouts/curriculum_list.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カリキュラムリスト</title>
    @vite(['resources/css/app.css']) <!-- CSSファイルへのリンク -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('curriculums.index') }}">時間割</a>
                <a href="/progress">授業進捗</a>
                <a href="/profile">プロフィール設定</a>
                <a href="/logout">ログアウト</a>
                <li><a href="/back">戻る</a></li>
            </ul>
        </nav>
    </header>

       <div class="container">
        <div class="flex-container">
        <div class="button-group">
            @foreach($grades as $grade)
                <button class="grade-button">{{ $grade->name }}</button>
            @endforeach
        </div>
       </div>
                   

               
            <div class="curriculum-list" >
                @foreach ($curriculums as $curriculum)
                    <div class="curriculum-item">
                        <img src="{{ $curriculum->thumbnail }}" alt="{{ $curriculum->title }}">
                        <h3>{{ $curriculum->title }}</h3>
                        <p>日時: {{ $curriculum->delivery_from }} - {{ $curriculum->delivery_to }}</p>
                    </div>
                @endforeach
            </div>
        </div>
</body>
</html>
