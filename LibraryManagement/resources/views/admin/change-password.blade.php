@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
<div class="main-content">

    <div class="page-content">

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Thay đổi mật khẩu</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thông tin cá nhân</a></li>
                                <li class="breadcrumb-item active">Đổi mật khẩu</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body py-5">
                            <form method="POST" action="{{ route('admin.save-password') }}">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label for="old-pass" class="col-sm-3 col-form-label">Mật khẩu cũ</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control @error('old-pass') is-invalid @enderror" id="old-pass" name="old-pass" value="{{ old('old-pass') }}" required placeholder="Nhập mật khẩu cũ">
                                        @error('old-pass')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="new-pass" class="col-sm-3 col-form-label">Mật khẩu mới</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control @error('new-pass') is-invalid @enderror" id="new-pass" name="new-pass" value="{{ old('new-pass') }}" required placeholder="Nhập mật khẩu mới">
                                        @error('new-pass')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="re-new-pass" class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control @error('re-new-pass') is-invalid @enderror" id="re-new-pass" name="re-new-pass" value="{{ old('re-new-pass') }}" required placeholder="Nhập lại mật khẩu mới">
                                        @error('re-new-pass')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary w-md">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection

@push('scripts')
<!-- App js -->
<script src="..\js\app.js"></script>
@endpush
