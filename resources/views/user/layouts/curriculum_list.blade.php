@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">授業一覧 - 小学校1年生</h2>
    <a href="#" class="btn btn-primary mb-4">新規授業登録</a>
    
    <div class="row">
        @foreach($curriculums as $curriculum)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($curriculum->thumbnail) }}" class="card-img-top" alt="授業画像">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curriculum->title }}</h5>
                        <p class="card-text">
                            <strong>配信状況:</strong> 
                            {{ $curriculum->alway_delivery_flag ? '配信中' : '非配信' }}
                        </p>
                        <a href="#" class="btn btn-primary">授業内容編集</a>
                        <a href="#" class="btn btn-secondary">配信資料編集</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
