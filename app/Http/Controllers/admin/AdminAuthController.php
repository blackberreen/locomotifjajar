<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin->username]);
            return redirect()->route('admin.home');
        } else {
            return back()->with('error', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.login');
    }

}

