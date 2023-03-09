@extends('layouts.app')
@section('title', 'Danh sách nhân viên')
@section('styles')
<!-- DataTables -->
<link href="..\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="..\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

<!-- Responsive datatable examples -->
<link href="..\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('message') }}
                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Danh sách nhân viên</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Quản lý nhân viên</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">Danh sách nhân viên</h4>
                                <a href="{{ route('admin.add-staff') }}" class="btn btn-primary w-md">Thêm thành viên</a>
                            </div>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Họ và tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Giới tính</th>
                                        <th>Tên tài khoản</th>
                                        <th>Mật khẩu</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ $staff->address }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>@if ($staff->gender == 1) Nam @else Nữ @endif</td>
                                        <td>{{ $staff->username }}</td>
                                        <td>{{ $staff->password }}</td>
                                        <td>
                                            <form action="{{ route('admin.edit-staff') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="text" value="{{ $staff->username }}" class="d-none" name="username">
                                                <button type="submit" class="btn btn-sm btn-primary">Sửa</button>
                                            </form>
                                            <form action="{{ route('admin.delete-staff', $staff->username) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Library Management.
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
<!-- Required datatable js -->
<script src="..\libs\datatables.net\js\jquery.dataTables.min.js"></script>
<script src="..\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="..\libs\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
<script src="..\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js"></script>
<script src="..\libs\jszip\jszip.min.js"></script>
<script src="..\libs\pdfmake\build\pdfmake.min.js"></script>
<script src="..\libs\pdfmake\build\vfs_fonts.js"></script>
<script src="..\libs\datatables.net-buttons\js\buttons.html5.min.js"></script>
<script src="..\libs\datatables.net-buttons\js\buttons.print.min.js"></script>
<script src="..\libs\datatables.net-buttons\js\buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="..\libs\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="..\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="..\js\pages\datatables.init.js"></script>

<script src="..\js\app.js"></script>
@endpush
