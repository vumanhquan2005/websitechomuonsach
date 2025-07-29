@extends('Layout.client')

@section('title', 'Đăng nhập')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg mt-5">
                <div class="card-header text-center bg-primary text-white">
                    <h4><i class="bi bi-box-arrow-in-right"></i> Đăng nhập tài khoản</h4>
                </div>
                <div class="card-body">
                    {{-- Form --}}
                    <form action="{{ route('login') }}" method="POST" autocomplete="off">
                        @csrf
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
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{ route('register') }}">Chưa có tài khoản? Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Đăng nhập thất bại',
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
