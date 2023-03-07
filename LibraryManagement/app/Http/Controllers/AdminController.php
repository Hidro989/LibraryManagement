<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        try {
            $admin = Admins::where('username', $username)->where('password', $password)->first();
            if ($admin) {
                // Nếu đăng nhập thành công, chuyển hướng đến trang dashboard
                $request->session()->put('loginId', $admin);
                return redirect()->route('dashboard');
            }
        } catch (\Throwable $th) {
            return redirect()->route('page404');
        }

        // Nếu đăng nhập không thành công, trả về trang đăng nhập và hiển thị thông báo lỗi
        return redirect()->back()->withErrors(['username' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

    public function logout(Request $request) {
        $request->session()->pull('loginId');
        return redirect()->route('login');
    }

    public function page404() {
        return view('error.page404');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
