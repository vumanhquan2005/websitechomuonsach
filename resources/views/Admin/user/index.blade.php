@extends('Layout.admin')

@section('title', 'Quản lý người dùng')

@section('contents')
    <div class="container">
        <h4 class="fw-bold mb-4"><i class="bi bi-people"></i> Danh sách người dùng</h4>

        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->role == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                    {{ $u->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary"
                                    title="Sửa quyền">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
@endsection
