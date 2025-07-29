<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // Xử lý đăng nhập
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        // Luôn về trang chủ, bất kể là admin hay user thường
        return redirect('/')->with('success', 'Đăng nhập thành công!');
    }

    // Thất bại, báo lỗi như cũ
    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không đúng!',
    ])->withInput($request->only('email'));
}


    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
