@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>{{ $curriculum->name }} 配信日時設定</h2>

    <!-- 授業タイトル表示 -->
    <p class="fw-bold fs-5">{{ $curriculum->title ?? '授業タイトルが入る' }}</p>

    <form action="{{ isset($deliveryTime) ? route('admin.delivery.update', ['curriculumId' => $curriculum->id, 'deliveryId' => $deliveryTime->id]) : route('admin.delivery.store', ['curriculumId' => $curriculum->id]) }}" method="POST">
        @csrf
        @if(isset($deliveryTime))
            @method('PUT')
        @endif

        <div id="delivery-times-container">
            @forelse ($deliveryTimes as $index => $deliveryTime)
            <div class="delivery-time-row d-flex align-items-center mb-2">
                <input type="date" class="form-control date-input me-2" name="delivery_times[{{ $index }}][from_date]"
                       value="{{ old("delivery_times.$index.from_date", $deliveryTime->delivery_from ? \Carbon\Carbon::parse($deliveryTime->delivery_from)->format('Y-m-d') : '') }}" required>
                <input type="time" class="form-control time-input me-2" name="delivery_times[{{ $index }}][from_time]"
                       value="{{ old("delivery_times.$index.from_time", $deliveryTime->delivery_from ? \Carbon\Carbon::parse($deliveryTime->delivery_from)->format('H:i') : '') }}" required>
                <span class="me-2">～</span>
                <input type="date" class="form-control date-input me-2" name="delivery_times[{{ $index }}][to_date]"
                       value="{{ old("delivery_times.$index.to_date", $deliveryTime->delivery_to ? \Carbon\Carbon::parse($deliveryTime->delivery_to)->format('Y-m-d') : '') }}" required>
                <input type="time" class="form-control time-input me-2" name="delivery_times[{{ $index }}][to_time]"
                       value="{{ old("delivery_times.$index.to_time", $deliveryTime->delivery_to ? \Carbon\Carbon::parse($deliveryTime->delivery_to)->format('H:i') : '') }}" required>
                <button type="button" class="btn btn-danger remove-row">−</button>
            </div>
            @empty
            <p class="text-muted">配信日時が登録されていません。新しい日時を追加してください。</p>
            @endforelse
        </div>

        <button type="button" id="add-row-button" class="btn btn-success mt-3">＋</button>

        <button type="submit" class="btn btn-primary mt-3">登録</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('delivery-times-container');
        const addButton = document.getElementById('add-row-button');

        // 新しい行を追加する関数
        function addNewRow() {
            const index = container.querySelectorAll('.delivery-time-row').length; // 現在の行数を取得
            const newRow = document.createElement('div');
            newRow.classList.add('delivery-time-row', 'd-flex', 'align-items-center', 'mb-2');
            newRow.innerHTML = `
                <input type="date" class="form-control date-input me-2" name="delivery_times[${index}][from_date]" required>
                <input type="time" class="form-control time-input me-2" name="delivery_times[${index}][from_time]" required>
                <span class="me-2">～</span>
                <input type="date" class="form-control date-input me-2" name="delivery_times[${index}][to_date]" required>
                <input type="time" class="form-control time-input me-2" name="delivery_times[${index}][to_time]" required>
                <button type="button" class="btn btn-danger remove-row">−</button>
            `;

            // 削除ボタンにイベントリスナー追加
            newRow.querySelector('.remove-row').addEventListener('click', () => newRow.remove());

            container.appendChild(newRow);
        }

        // 行追加ボタンのクリックイベント
        addButton.addEventListener('click', addNewRow);

        // 初期表示時、削除ボタンのイベントリスナー設定
        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function () {
                button.parentElement.remove();
            });
        });
    });
</script>
@endsection
