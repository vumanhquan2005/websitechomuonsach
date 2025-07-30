@extends('Layout.admin')

@section('title', 'Danh mục')

@section('contents')
    <div class="container mt-4">
        <h3 class="mb-4">Danh sách danh mục</h3>

        <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-3">+ Thêm danh mục</a>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Danh mục cha</th>
                    <th>Ảnh</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ optional($category->parent)->name ?? '-' }}</td>
                        <td>
                            @if ($category->images)
                                <img src="{{ asset('storage/' . $category->images) }}" alt="Ảnh" width="60"
                                    height="80">
                            @else
                                <em>Không có</em>
                            @endif
                        </td>
                        <td>{{ $category->created_at ? $category->created_at->format('d/m/Y') : '' }}</td>
                        <td>
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>

                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                class="delete-form d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete">Xóa</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Chưa có danh mục nào</td>
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
