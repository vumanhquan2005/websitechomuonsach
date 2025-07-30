@extends('Layout.admin')

@section('title', 'Sách')

@section('contents')
    <div class="container mt-4">
        <h3 class="mb-3">Danh sách sách</h3>
        <a href="{{ route('admin.book.create') }}" class="btn btn-primary mb-3">Thêm sách mới</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ảnh bìa</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Còn lại</th>
                    <th>Năm XB</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" width="60">
                            @else
                                <em>Không có</em>
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ optional($book->category)->name ?? '-' }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{ $book->available }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>
                            @if ($book->status)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.book.edit', $book->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                            <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Không có sách nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection


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

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn xóa?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
