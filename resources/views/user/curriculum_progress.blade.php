@extends('user.layouts.app')

@section('title', $user->name . 'の授業進捗')

@section('content')
<div class="container">
    <a href="#" class="back">← 戻る</a>

    <div class="user-container">
    
        @php
            $gradeClass = match($userGrade->name) {
                '小学校1年生', '小学校2年生', '小学校3年生', '小学校4年生', '小学校5年生', '小学校6年生' => 'elementary',
                '中学校1年生', '中学校2年生', '中学校3年生' => 'junior-high',
                '高校1年生', '高校2年生', '高校3年生' => 'high-school',
            };
        @endphp

        <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像">
        <div class="user-info">
            <h2 class="user-progress-title">{{ $user->name }}さんの授業進捗</h2>
            <h2>現在の学年： 
                    <span class="user-grade {{ $gradeClass }}">{{ $userGrade->name }}</span>
            </h2>
        </div>
    </div>
    
    <div class="grade-container">
    
        {{-- 全学年をループ --}}
        @foreach ($grades as $grade)

        @php
            $gradeClass = match($grade->name) {
                '小学校1年生', '小学校2年生', '小学校3年生', '小学校4年生', '小学校5年生', '小学校6年生' => 'elementary',
                '中学校1年生', '中学校2年生', '中学校3年生' => 'junior-high',
                '高校1年生', '高校2年生', '高校3年生' => 'high-school',
                default => '',
            };
        @endphp

        <div class="grade-wrapper">
                <p class="grade {{ $gradeClass }}">{{ $grade->name }}</p>
                    @foreach ($grade->curriculums as $curriculum)
                        <div class="progress-item">
                            @if ($curriculum->clearFlg)
                                <span class="clear">受講済</span>
                            @else
                                <span class="clear no-clear">受講済</span>
                            @endif
                            <button class="curriculum-title" @if ($curriculum->isDisabled) disabled @endif>
                                <p>{{ $curriculum->title }}</p>
                            </button>
                        </div>
                    @endforeach
        </div>
    
        @endforeach
    </div>
</div>
@endsection
