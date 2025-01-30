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
                <li><a href="{{ route('show.curriculum.list') }}">時間割</a></li>
                <li><a href="/progress">授業進捗</a></li>
                <li><a href="/profile">プロフィール設定</a></li>
                <li><a href="/logout">ログアウト</a></li>
            </ul>
        </nav>
    </header> {{-- @include('admin.layouts.app') --}}
    
    <a href="{{ route('show.top') }}">←戻る</a>

        <div class="delivery-time">
            <button id="prevMonth">◀</button>
            <p id="currentDate">〇〇年〇〇月スケジュール</p>
            <button id="nextMonth">▶</button>
            <p id="currentGrade" class="{{ $grades->first()->name }}">{{ $grades->first()->name }}</p>
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
                    <button class="{{ $buttonClass }}" data-grade-id="{{ $grade->id }}">{{ $grade->name }}</button>
                    @endforeach
            </div>
            
                

           <div class="curriculum-list">
    @foreach ($curriculums as $curriculum)
        <div class="curriculum-item" data-grade="{{ $curriculum->grade_id }}">
            <img src="{{ asset('images/' . $curriculum->thumbnail) }}" alt="{{ $curriculum->title }}">
            <h3>{{ $curriculum->title }}</h3>
            @foreach ($curriculum->deliveryTimes as $deliveryTime)
                <p>日時: {{ $deliveryTime->delivery_from }} - {{ $deliveryTime->delivery_to }}</p>
            @endforeach
        </div>
    @endforeach
</div>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentDateElement = document.getElementById('currentDate');
            const prevMonthButton = document.getElementById('prevMonth');
            const nextMonthButton = document.getElementById('nextMonth');
            const currentGradeElement = document.getElementById('currentGrade');
            const gradeButtons = document.querySelectorAll('.grade-button');
            const curriculumItems = document.querySelectorAll('.curriculum-item');

            let currentDate = new Date();
            let currentGradeIndex = 0;
            const grades = @json($grades->pluck('name')); // gradesテーブルのnameカラムをJavaScriptに渡す

            function updateDateDisplay() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth() + 1; // 月は0から始まるので+1する
                currentDateElement.textContent = `${year}年${month}月スケジュール`;
            }

            function updateGradeDisplay() {
                currentGradeElement.textContent = grades[currentGradeIndex];
                gradeButtons.forEach(button => {
                if (button.textContent === grades[currentGradeIndex]) {
                currentGradeElement.className = button.className;
                }
            });

                // カリキュラムのフィルタリング
                const selectedGradeId = gradeButtons[currentGradeIndex].dataset.gradeId;
                curriculumItems.forEach(item => {
                if (item.dataset.grade == selectedGradeId) {
                    item.style.display = 'block';
                } else {
                item.style.display = 'none';
            }
    });
}

            gradeButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    currentGradeIndex = index;
                    updateGradeDisplay();
                });
            });

            prevMonthButton.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateDateDisplay();
            });

            nextMonthButton.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateDateDisplay();
            });

            // 初期表示
            updateDateDisplay();
            updateGradeDisplay();
        });
    </script>
</body>
</html>