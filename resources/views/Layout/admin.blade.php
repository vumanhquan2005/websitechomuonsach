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
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle d-flex align-items-center" href="#" role="button"
                    id="dropdownAccount" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-5 me-2"></i>
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <li>
                        <a class="dropdown-item" href="{{ url('/') }}">
                            <i class="bi bi-house"></i> Về trang chủ
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <!-- Logout phải là POST như hướng dẫn trước -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
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
