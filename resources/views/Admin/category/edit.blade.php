@extends('Layout.admin')

@section('title', 'Sửa danh mục')

@section('contents')
    <div class="container mt-4">
        <h3 class="mb-3">Sửa danh mục</h3>

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Danh mục cha</label>
                <select name="parent_id" id="parent_id" class="form-select">
                    <option value="">-- Không có --</option>
                    @foreach ($categories as $cat)
                        @if ($cat->id != $category->id)
                            <option value="{{ $cat->id }}"
                                {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Ảnh danh mục</label>
                @if ($category->images)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $category->images) }}" width="100">
                    </div>
                @endif
                <input type="file" name="images" id="images" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
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
