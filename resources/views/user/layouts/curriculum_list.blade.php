<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カリキュラムリスト</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('curriculums.index') }}">時間割</a></li>
                <li><a href="/progress">授業進捗</a></li>
                <li><a href="/profile">プロフィール設定</a></li>
                <li><a href="/logout">ログアウト</a></li>
            </ul>
        </nav>
    </header>
    <a href="/back">←戻る</a>
    <div class="derivery-time">
                <button>◀</button>
                <p>〇〇年〇〇月スケジュール</p>
                <button>▶</button>
    </div>
    
    <div class="container">
        <div class="flex-container">
            <div class="button-group">
                @foreach($grades as $grade)
                    @php
                        $buttonClass = '';
                        switch ($grade->name) {
                        case '小学1年生':
                        case '小学2年生':
                        case '小学3年生':
                        case '小学4年生':
                        case '小学5年生':
                        case '小学6年生':
                            $buttonClass = 'grade-button grade-1';
                            break;
                        case '中学1年生':
                        case '中学2年生':
                        case '中学3年生':
                            $buttonClass = 'grade-button grade-2';
                            break;
                        case '高校1年生':
                        case '高校2年生':
                        case '高校3年生':
                            $buttonClass = 'grade-button grade-3';
                            break;
                        default:
                            $buttonClass = 'grade-button';
                            break;
                        }
                    @endphp
                    <button class="{{ $buttonClass }}">{{ $grade->name }}</button>
                @endforeach
            </div>
            
                

            <div class="curriculum-list">
                @foreach ($curriculums as $curriculum)
                    <div class="curriculum-item">
                        <img src="{{ $curriculum->thumbnail }}" alt="{{ $curriculum->title }}">
                        <h3>{{ $curriculum->title }}</h3>
                        <p>日時: {{ $curriculum->delivery_from }} - {{ $curriculum->delivery_to }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>