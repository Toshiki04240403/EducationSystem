<!-- 配信日時設定ページ -->
@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('curriculum.index') }}" class="btn btn-link">&larr; 戻る</a>
    <h2>配信日時設定</h2>
    <h4>{{ $curriculum->title ?? '授業タイトルが入る' }}</h4> <!-- 授業タイトルを動的に表示 -->

    <form method="POST" action="{{ route('delivery.store', $curriculum->id ?? '') }}">
        @csrf
        <div id="schedule-fields">
            <!-- 初期フィールド -->
            <div class="row align-items-center mb-3 schedule-field">
                <div class="col-md-3">
                    <input type="date" name="start_date[]" class="form-control" required placeholder="年/月/日">
                </div>
                <div class="col-md-2">
                    <input type="time" name="start_time[]" class="form-control" required placeholder="時:分">
                </div>
                <div class="col-md-1 text-center">
                    <span>～</span>
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date[]" class="form-control" required placeholder="年/月/日">
                </div>
                <div class="col-md-2">
                    <input type="time" name="end_time[]" class="form-control" required placeholder="時:分">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-field">&minus;</button>
                </div>
            </div>
        </div>
        <!-- フィールド追加ボタン -->
        <button type="button" class="btn btn-success mb-3" id="add-field">＋</button>
        <!-- フォーム送信ボタン -->
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleFields = document.getElementById('schedule-fields');
        const addFieldButton = document.getElementById('add-field');

        // フィールドテンプレートを生成
        function getFieldTemplate() {
            return `
                <div class="row align-items-center mb-3 schedule-field">
                    <div class="col-md-3">
                        <input type="date" name="start_date[]" class="form-control" required placeholder="年/月/日">
                    </div>
                    <div class="col-md-2">
                        <input type="time" name="start_time[]" class="form-control" required placeholder="時:分">
                    </div>
                    <div class="col-md-1 text-center">
                        <span>～</span>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date[]" class="form-control" required placeholder="年/月/日">
                    </div>
                    <div class="col-md-2">
                        <input type="time" name="end_time[]" class="form-control" required placeholder="時:分">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-field">&minus;</button>
                    </div>
                </div>`;
        }

        // 新しいフィールドを追加
        addFieldButton.addEventListener('click', () => {
            scheduleFields.insertAdjacentHTML('beforeend', getFieldTemplate());
        });

        // フィールドを削除
        scheduleFields.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-field')) {
                const field = e.target.closest('.schedule-field');
                if (field) field.remove();
            }
        });
    });
</script>
@endsection
