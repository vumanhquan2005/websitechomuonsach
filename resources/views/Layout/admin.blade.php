<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Quản trị hệ thống mượn sách')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optionally, dùng icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f6f8fa;
        }

        .main-header {
            background: #343a40;
            color: #fff;
            padding: 15px 0;
            margin-bottom: 24px;
        }

        .main-footer {
            background: #222;
            color: #aaa;
            padding: 15px 0;
            margin-top: 36px;
        }

        .nav-link {
            color: #fff !important;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #ffc107 !important;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-book-half"></i>
                <span class="fs-4 fw-bold ms-2">Trang Quản Trị Mượn Sách</span>
            </div>
            <nav>
                <a href=""
                    class="nav-link d-inline-block {{ request()->is('categories*') ? 'active' : '' }}">Danh mục</a>
                <a href="" class="nav-link d-inline-block {{ request()->is('books*') ? 'active' : '' }}">Sách</a>
                <a href=""
                    class="nav-link d-inline-block {{ request()->is('borrow_records*') ? 'active' : '' }}">Mượn/Trả</a>
                <a href="" class="nav-link d-inline-block {{ request()->is('users*') ? 'active' : '' }}">Người
                    dùng</a>
            </nav>
            <div>
                <span class="me-2"><i class="bi bi-person-circle"></i> Admin</span>
                <a href="" class="btn btn-sm btn-warning">Đăng xuất</a>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <div class="container">
        @yield('contents')
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        &copy; {{ date('Y') }} - Hệ thống mượn sách | FPT Polytechnic
    </footer>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>
