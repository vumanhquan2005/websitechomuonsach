<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Trang quản trị')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #f7fafc;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: #fff;
        }

        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: rgba(0, 0, 0, 0.13);
            color: #fff;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .main-footer {
            background: #212529;
            color: #bbb;
            padding: 16px 0;
            margin-top: 32px;
        }

        .header-admin {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px 0 16px;
        }

        .header-admin .dropdown-toggle {
            background: none;
            border: none;
            color: #333;
            font-weight: 600;
            box-shadow: none !important;
        }

        .header-admin .dropdown-menu {
            min-width: 180px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 240px;">
            <div class="mb-4 text-center">
                <img src="/logo.png" alt="Logo" style="height: 54px;">
                <div class="logo mt-2">Mượn Sách Admin</div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-bar-chart"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i> Người Dùng
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.book.*') ? 'active' : '' }}"
                        href="{{ route('admin.book.index') }}">
                        <i class="bi bi-journal-bookmark"></i> Sách
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}"
                        href="{{ route('admin.category.index') }}">
                        <i class="bi bi-tags"></i> Danh Mục
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.borrow-records.*') ? 'active' : '' }}"
                        href="{{ route('admin.borrow-records.index') }}">
                        <i class="bi bi-bookmark-check"></i> Phiếu Mượn Sách
                    </a>
                </li>
                <!-- Thêm mục khác nếu muốn -->
            </ul>
        </div>
        <!-- Main content -->
        <div class="flex-grow-1" style="min-height: 100vh;">
            <!-- Header Admin -->
            <div class="header-admin">
                <h4 class="mb-0">@yield('title')</h4>
                <div class="dropdown">
                    <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button"
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
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-4">
                @yield('contents')
            </div>
        </div>
    </div>
    <footer class="main-footer text-center">
        &copy; {{ date('Y') }} - Quản trị hệ thống mượn sách | FPT Polytechnic
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>
