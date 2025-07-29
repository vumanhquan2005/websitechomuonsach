<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f7fafc;
        }

        .main-footer {
            background: #212529;
            color: #bbb;
            padding: 16px 0;
            margin-top: 48px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-book"></i> Mượn Sách Online
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarClient"
                aria-controls="navbarClient" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarClient">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Tất cả Sách</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Thể loại</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('borrow_records.index') }}">Lịch sử mượn</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item"><span class="nav-link"><i class="bi bi-person-circle"></i>
                                {{ auth()->user()->name }}</span></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container">
        @yield('contents')
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        &copy; {{ date('Y') }} - Hệ thống mượn sách online | FPT Polytechnic
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>
