<div class="header">
    <div class="left-buttons">
        <button onclick="location.href='{{ route('admin.curriclum.list') }}'">授業管理</button>
        <button onclick="location.href='{{ route('admin.article.list') }}'">お知らせ管理</button>
        <button onclick="location.href='{{ route('admin.banner.edit') }}'">バナー管理</button>
    </div>
    <div class="right-buttons">
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>