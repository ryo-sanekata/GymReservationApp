<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>施設予約アプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">施設予約アプリ</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('facilities.index') }}">施設一覧(TOP)</a>
                    </li>
                    @auth
                        <!-- 管理者の場合は「管理者ページ」を表示 -->
                        @if(auth()->user()->admin)
                            <li class="nav-item">
                                <a href="{{ route('mypage') }}" class="nav-link">管理者ページ</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('mypage') }}" class="nav-link">マイページ</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="nav-link" onclick="event.preventDefault(); confirmLogout();">ログアウト</a>
                        </li>
                    @endauth
                    <!-- @auth
                        @if(auth()->user()->admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.facilities.create') }}">施設登録</a>
                            </li>
                        @endif
                    @endauth -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">会員登録</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <!-- コンテンツをここに埋め込む -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <!-- ログアウト確認のJS -->
    <script type="text/javascript">
        function confirmLogout() {
            if (confirm('本当にログアウトしますか？')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
