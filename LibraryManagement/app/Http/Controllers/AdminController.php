<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function staffManagement() {
        $staffs = Staffs::all()->lazy();
        return view('admin.staff.staffManagement', compact('staffs'));
    }

    public function addStaff() {
        return view('admin.staff.addStaff');
    }

    public function saveAddStaff(Request $request)
    {
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $gender = $request->input('gender') ? $request->input('gender') : 'Nam';
        $phone = $request->input('phone') ? $request->input('phone') : '';
        $address = $request->input('address') ? $request->input('address') : '';

        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => "Họ và tên chưa được nhập",
                'username.required' => "Tài khoản chưa được nhập",
                'password.required' => "Mật khẩu chưa được nhập",
            ]
        );

        try {
            $staff = Staffs::where('username', $username)->first();
            if ($staff) {
                return redirect()->back()->withErrors(['username' => 'Tài khoản đã có']);
            }
            Staffs::insert([
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'gender' => $gender == "Nam" ? 1 : 0,
                'phone' => $phone,
                'address' => $address
            ]);
            return redirect()->route('admin.staff-management')->with(['message' => 'Thêm mới thành công']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['message' => 'Thêm mới thất bại']);
        }
    }

    public function editStaff(Request $request)
    {
        $staff = Staffs::where("username", $request->all()['username'])->first();
        return view('admin.staff.editStaff', compact('staff'));
    }

    public function saveEditStaff(Request $request)
    {
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $gender = $request->input('gender') ? $request->input('gender') : 'Nam';
        $phone = $request->input('phone') ? $request->input('phone') : '';
        $address = $request->input('address') ? $request->input('address') : '';


        $newStaff = $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
                'gender' => 'nullable',
                'phone' => 'nullable',
                'address' => 'nullable'
            ],
            [
                'name.required' => "Họ và tên chưa được nhập",
                'username.required' => "Tài khoản chưa được nhập",
                'password.required' => "Mật khẩu chưa được nhập",
            ]
        );

        try {
            $oldStaff = Staffs::where('username', $username)->first();
            if (!$oldStaff) {
                Staffs::insert([
                    'name' => $name,
                    'username' => $username,
                    'password' => $password,
                    'gender' => $gender == "Nam" ? 1 : 0,
                    'phone' => $phone,
                    'address' => $address
                ]);
                return redirect()->route('admin.staff-management')->with(['message' => 'Thêm mới thành công']);
            }
            Staffs::where('username', $username)->update(
                [
                    'name' => $name,
                    'username' => $username,
                    'password' => $password,
                    'gender' => $gender == "Nam" ? 1 : 0,
                    'phone' => $phone,
                    'address' => $address
                ]
            );
            return redirect()->route('admin.staff-management')->with(['message' => 'Sửa thành công']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['message' => 'Sửa thất bại']);
        }
    }

    public function deleteStaff(String $username) {
        try {
            Staffs::where('username', $username)->delete();
            return redirect()->route('admin.staff-management')->with(['message' => 'Xóa thành công']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['message' => 'Xóa thất bại']);
        }
    }

    public function statisticalAllBook() {
        $borrowedBook = Book::where('status', 1)->count();
        $remainingBook = Book::where('status', 0)->count();
        return View::make('admin.statistical')->with(compact('borrowedBook'))->with(compact('remainingBook'));
    }
}
