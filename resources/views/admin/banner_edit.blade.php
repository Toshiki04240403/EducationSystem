<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>バナー管理</title>
    @vite(['resources/css/app.css'])
    <style>
        .delete-icon {
            cursor: pointer;
            color: #dc3545;
            font-size: 1.5em;
        }
        .add-icon {
            cursor: pointer;
            color: #28a745;
            font-size: 2em;
            display: block;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    @include('admin.layouts.app')
    <a href="{{ route('show.top') }}">←戻る</a>
    <div class="content">
        <h2>バナー管理</h2>
        <div class="banners">
            @foreach ($banners as $banner)
                <div class="banner" data-banner-id="{{ $banner->id }}">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="バナー画像" class="image-preview">
                    <form action="{{ route('admin.banners.delete', $banner->id) }}" method="POST" class="delete-form" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <span class="delete-icon" onclick="this.closest('form').submit();">&times;</span>
                    </form>
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="update-form" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image" accept="image/*" class="image-input">
                    </form>
                </div>
            @endforeach
        </div>
        <span class="add-icon" id="addBanner">＋</span>
        <div class="banner-actions" id="newBannerFormContainer" style="display: none;">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="store-form" style="display: inline;">
                @csrf
                <input type="file" name="image" accept="image/*" class="image-input">
            </form>
        </div>
        <button id="applyChanges" class="btn btn-success">登録</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-icon');
            const applyChangesButton = document.getElementById('applyChanges');
            const imageInputs = document.querySelectorAll('.image-input');
            const addBannerButton = document.getElementById('addBanner');
            const newBannerFormContainer = document.getElementById('newBannerFormContainer');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bannerDiv = this.closest('.banner');
                    bannerDiv.classList.add('to-delete');
                    bannerDiv.remove(); // バナー要素をDOMから削除
                });
            });

            applyChangesButton.addEventListener('click', function () {
                const bannersToDelete = document.querySelectorAll('.banner.to-delete .delete-form');
                const bannersToUpdate = document.querySelectorAll('.banner .update-form');
                const bannersToStore = document.querySelectorAll('.store-form');

                bannersToDelete.forEach(form => {
                    form.submit();
                });

                bannersToUpdate.forEach(form => {
                    const input = form.querySelector('.image-input');
                    if (input.files.length > 0) {
                        form.submit();
                    }
                });

                bannersToStore.forEach(form => {
                    const input = form.querySelector('.image-input');
                    if (input.files.length > 0) {
                        form.submit();
                    }
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

            addBannerButton.addEventListener('click', function () {
                newBannerFormContainer.style.display = 'block';
            });
        });
    </script>
</body>
</html>