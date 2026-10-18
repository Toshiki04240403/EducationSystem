document.addEventListener('DOMContentLoaded', function () {
    const addRowButton = document.getElementById('add-row-button');
    const container = document.getElementById('delivery-times-container');

    // 行を追加する機能
    addRowButton.addEventListener('click', function () {
        const rowCount = container.querySelectorAll('.delivery-time-row').length;

        // 新しい行のHTML
        const newRow = document.createElement('div');
        newRow.classList.add('delivery-time-row');
        newRow.innerHTML = `
            <input type="date" class="form-control date-input" name="delivery_times[${rowCount}][from_date]" value="">
            <input type="time" class="form-control time-input" name="delivery_times[${rowCount}][from_time]" value="">
            <span>～</span>
            <input type="date" class="form-control date-input" name="delivery_times[${rowCount}][to_date]" value="">
            <input type="time" class="form-control time-input" name="delivery_times[${rowCount}][to_time]" value="">
            <button type="button" class="btn btn-danger remove-row">−</button>
        `;

        container.appendChild(newRow);
    });

    // 行を削除する機能
    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const row = e.target.closest('.delivery-time-row');
            if (row) {
                row.remove();
            }
        }
    });
});
