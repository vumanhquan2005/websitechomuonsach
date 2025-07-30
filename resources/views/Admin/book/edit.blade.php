@extends('Layout.admin')

@section('title', 'Sửa sách')

@section('contents')
    <div class="container mt-4">
        <h3 class="mb-3">Sửa thông tin sách</h3>

        <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tên sách</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $book->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Tác giả</label>
                <input type="text" name="author" id="author" class="form-control"
                    value="{{ old('author', $book->author) }}">
            </div>

            <div class="mb-3">
                <label for="publisher" class="form-label">Nhà xuất bản</label>
                <input type="text" name="publisher" id="publisher" class="form-control"
                    value="{{ old('publisher', $book->publisher) }}">
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">Mã ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control"
                    value="{{ old('isbn', $book->isbn) }}">
            </div>

            <div class="mb-3">
                <label for="language" class="form-label">Ngôn ngữ</label>
                <input type="text" name="language" id="language" class="form-control"
                    value="{{ old('language', $book->language) }}">
            </div>

            <div class="mb-3">
                <label for="pages" class="form-label">Số trang</label>
                <input type="number" name="pages" id="pages" class="form-control"
                    value="{{ old('pages', $book->pages) }}">
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Năm xuất bản</label>
                <input type="number" name="published_year" id="published_year" class="form-control"
                    value="{{ old('published_year', $book->published_year) }}">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="form-control"
                    value="{{ old('quantity', $book->quantity) }}">
            </div>

            <div class="mb-3">
                <label for="available" class="form-label">Còn lại</label>
                <input type="number" name="available" id="available" class="form-control"
                    value="{{ old('available', $book->available) }}">
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Ảnh bìa</label><br>
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" class="mb-2">
                @endif
                <input type="file" name="cover_image" id="cover_image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái hiển thị</label>
                <select name="status" class="form-select">
                    <option value="1" {{ old('status', $book->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ old('status', $book->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.book.index') }}" class="btn btn-secondary">Quay lại</a>
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
