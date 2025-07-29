@extends('Layout.client')

@section('title', 'Đăng ký')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg mt-5">
                <div class="card-header text-center bg-primary text-white">
                    <h4><i class="bi bi-person-plus"></i> Đăng ký tài khoản</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('register') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}" placeholder="Nhập họ tên...">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email') }}" placeholder="Nhập email...">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Nhập mật khẩu...">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required placeholder="Nhập lại mật khẩu...">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-person-plus"></i> Đăng ký
                        </button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Đăng ký thất bại',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

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
@endsection

@endsection
