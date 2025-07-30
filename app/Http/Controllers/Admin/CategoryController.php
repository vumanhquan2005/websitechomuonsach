<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:categories,id',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['name', 'parent_id']);

    $data['slug'] = Str::slug($data['name']);

    if ($request->hasFile('images')) {
        $path = $request->file('images')->store('categories', 'public');
        $data['images'] = $path;
    }

    Category::create($data);

    return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
}
public function edit($id)
{
    $category = Category::findOrFail($id);
    $categories = Category::where('id', '!=', $id)->get(); // Không cho chọn chính nó làm cha

    return view('admin.category.edit', compact('category', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:categories,id',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $category = Category::findOrFail($id);

    $data = $request->only(['name', 'parent_id']);
    $data['slug'] = Str::slug($data['name']);

    if ($request->hasFile('images')) {
        $path = $request->file('images')->store('categories', 'public');
        $data['images'] = $path;
    }

    $category->update($data);

    return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công');
}
public function destroy($id)
{
    $category = Category::findOrFail($id);

    // Nếu dùng soft delete
    $category->delete();

    return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công');
}

}
