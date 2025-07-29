<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Trang dashboard admin
    public function index()
    {
        return view('Admin.dashboard');
    }
}
