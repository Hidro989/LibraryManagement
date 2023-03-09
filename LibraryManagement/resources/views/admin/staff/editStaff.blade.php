@extends('layouts.app')
@section('title', 'Sửa nhân viên')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Sửa nhân viên</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.staff-management') }}">Quản lý nhân viên</a></li>
                                <li class="breadcrumb-item active">Sửa nhân viên</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Thông tin</h4>
                            <form class="outer-repeater" method="POST" action="/admin/edit-staff">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Họ và tên :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $staff->name }}" placeholder="Nhập họ và tên...">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Tài khoản :</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $staff->username }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Mật khẩu :</label>
                                    <input id="password" name="password" type="text" class="form-control @error('password') is-invalid @enderror" value="{{ $staff->password }}">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="inner-repeater mb-4">
                                    <button type="button" id="addAccount" class="btn btn-success inner">Tạo tài khoản</button>
                                </div>

                                <div class="form-group">
                                    <label class="d-block mb-3">Giới tính :</label>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="male" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Nam" @if($staff->gender == 1) checked @else "" @endif>
                                        <label class="custom-control-label" for="male">Nam</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="female" name="gender" class="custom-control-input @error('gender') is-invalid @enderror" value="Nữ" @if($staff->gender == 0) checked @else "" @endif>
                                        <label class="custom-control-label" for="female">Nữ</label>
                                    </div>
                                    @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Số điện thoại :</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $staff->phone }}" placeholder="Nhập số điện thoại...">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Địa chỉ :</label>
                                    <input id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $staff->address }}" placeholder="Nhập địa chỉ...">
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Sửa nhân viên</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Library.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Design & Develop by HeroesPluss
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar="" class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0">
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="..\images\layouts\layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked="">
                <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="..\images\layouts\layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsstyle="../css/bootstrap-dark.min.css" data-appstyle="../css/app-dark.min.css">
                <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="..\images\layouts\layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appstyle="../css/app-rtl.min.css">
                <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@endsection
@push('scripts')
<!-- form repeater js -->
<script src="..\libs\jquery.repeater\jquery.repeater.min.js"></script>

<script src="..\js\pages\form-repeater.int.js"></script>

<script src="..\js\app.js"></script>

<script>
    const addAccountBtn = document.querySelector('#addAccount');
    const username = document.querySelector('#username');
    const password = document.querySelector('#password');
    const userExam = 'staff';
    const permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const random = (length) => {
        let result = '';
        const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    }

    addAccountBtn.addEventListener('click', () => {
        username.value = userExam + random(2) + Date.parse((new Date()).toUTCString()) + random(2);
        password.value = random(8);
    })
</script>
@endpush
