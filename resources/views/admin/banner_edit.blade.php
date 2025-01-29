<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>バナー管理</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    @include('admin.layouts.app')
    <a href="{{ route('show.top') }}">←戻る</a>
    <div class="content">
        <h2>バナー管理</h2>
        <div class="banners">
            @foreach ($banners as $banner)
                <div class="banner" data-banner-id="{{ $banner->id }}">
                    <img src="{{ asset($banner->image) }}" alt="バナー画像" class="image-preview">
                    <form action="{{ route('admin.banners.delete', $banner->id) }}" method="POST" class="delete-form" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-button">削除</button>
                    </form>
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="update-form" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image" accept="image/*" class="image-input">
                        <button type="button" class="btn btn-primary update-button">ファイルを追加</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="banner-actions">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="store-form" style="display: inline;">
                @csrf
                <input type="file" name="image" accept="image/*" class="image-input">
                <button type="button" class="btn btn-primary store-button">ファイル選択</button>
            </form>
        </div>
        <button id="applyChanges" class="btn btn-success">登録</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const updateButtons = document.querySelectorAll('.update-button');
            const storeButton = document.querySelector('.store-button');
            const applyChangesButton = document.getElementById('applyChanges');
            const imageInputs = document.querySelectorAll('.image-input');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bannerDiv = this.closest('.banner');
                    bannerDiv.classList.add('to-delete');
                    bannerDiv.remove(); // バナー要素をDOMから削除
                });
            });

            updateButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bannerDiv = this.closest('.banner');
                    bannerDiv.classList.add('to-update');
                });
            });

            storeButton.addEventListener('click', function () {
                const storeForm = this.closest('.store-form');
                storeForm.classList.add('to-store');
            });

            applyChangesButton.addEventListener('click', function () {
                const bannersToDelete = document.querySelectorAll('.banner.to-delete .delete-form');
                const bannersToUpdate = document.querySelectorAll('.banner.to-update .update-form');
                const bannersToStore = document.querySelectorAll('.store-form.to-store');

                bannersToDelete.forEach(form => {
                    form.submit();
                });

                bannersToUpdate.forEach(form => {
                    form.submit();
                });

                bannersToStore.forEach(form => {
                    form.submit();
                });
            });

            imageInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const bannerDiv = input.closest('.banner');
                            let preview = bannerDiv.querySelector('.image-preview');
                            if (!preview) {
                                preview = document.createElement('img');
                                preview.classList.add('image-preview');
                                bannerDiv.appendChild(preview);
                            }
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
</body>
</html>