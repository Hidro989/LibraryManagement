<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Staffs;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $user = null;
    private $page = 'home';

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {
            if($username == 'admin') {
                $this->user = Admins::where('username', $username)->where('password', $password)->first();
                $this->page = "dashboard";
            }
            else $this->user = Staffs::where('username', $username)->where('password', $password)->first();
            if ($this->user) {
                // Nếu đăng nhập thành công, chuyển hướng đến trang dashboard
                $request->session()->put('loginUsername', $this->user->username);
                return redirect()->route($this->page);
            }
        } catch (\Throwable $th) {
            return redirect()->route('page404');
        }

        // Nếu đăng nhập không thành công, trả về trang đăng nhập và hiển thị thông báo lỗi
        return redirect()->back()->withErrors(['username' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

    public function logout(Request $request)
    {
        $request->session()->pull('loginUsername');
        return redirect()->route('login');
    }

    public function page404()
    {
        return view('error.page404');
    }

    public function changePassword(Request $request)
    {
        if($request->session()->get('loginUsername') == 'admin')
            return view('admin.change-password');
        return view('staff.change-password');
    }

    public function saveChangePassword(Request $request)
    {
        $username = $request->session()->get('loginUsername');
        $oldPass = $request->input('old-pass');
        $newPass = $request->input('new-pass');

        $request->validate(
            [
            're-new-pass' => 'same:new-pass',
            ],
            [
                're-new-pass.same' => 'Nhập lại mật khẩu không chính xác'
            ]
        );
        try {
            $this->user = null;
            if ($username == 'admin')
                $this->user = Admins::where('username', $username)->where('password', $oldPass)->first();
            else $this->user = Staffs::where('username', $username)->where('password', $oldPass)->first();
            if ($this->user) {
                if($username == 'admin') Admins::where('username', $username)->update(['password' => $newPass]);
                else Staffs::where('username', $username)->update(['password' => $newPass]);
                return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công');
            }
            return redirect()->back()->withErrors(['old-pass' => 'Mật khẩu không đúng']);
        } catch (\Throwable $th) {
            dd($th); exit;
        }
    }
}
