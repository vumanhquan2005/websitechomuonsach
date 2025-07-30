<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.book.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quantity' => 'required|integer|min:0',
            'available' => 'nullable|integer|min:0',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
            'status' => 'nullable|in:0,1',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['created_by'] = Auth::id();
        $data['available'] = $data['available'] ?? $data['quantity'];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.book.index')->with('success', 'Thêm sách thành công');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.book.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quantity' => 'required|integer|min:0',
            'available' => 'nullable|integer|min:0',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:50',
            'pages' => 'nullable|integer|min:1',
            'status' => 'nullable|in:0,1',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['available'] = $data['available'] ?? $data['quantity'];

        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ nếu có
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.book.index')->with('success', 'Cập nhật sách thành công');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Xóa ảnh nếu có
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.book.index')->with('success', 'Xóa sách thành công');
    }
}
