<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hiển thị danh sách user (trừ admin đang đăng nhập)
    public function index()
    {
        $users = User::where('id', '<>', Auth::id())->get();
        return view('Admin.User.index', compact('users'));
    }

    // Form sửa quyền user
    public function edit($id)
    {
        if ($id == Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể sửa chính mình!');
        }
        $user = User::findOrFail($id);
        return view('Admin.User.edit', compact('user'));
    }

    // Lưu cập nhật quyền user
    public function update(Request $request, $id)
    {
        if ($id == Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể sửa chính mình!');
        }
        $user = User::findOrFail($id);
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);
        $user->role = $request->role;
        $user->save();
       return redirect()->route('admin.users.index')->with('success', 'Cập nhật quyền thành công!');

    }
}
