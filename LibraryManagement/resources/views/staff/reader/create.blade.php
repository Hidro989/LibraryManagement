﻿@extends('layouts.app-staff')
@section('title', 'Thêm đọc giả')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Thêm đọc giả</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reader.index') }}">Quản lý đọc giả</a></li>
                                <li class="breadcrumb-item active">Thêm đọc giả</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Thêm đọc giả</h4>
                            @include('common.errors')

                            <form class="outer-repeater" action="{{route('reader.store')}}" method="POST">
                                @csrf
                                <div class="outer">
                                    <div class="outer">

                                        <div class="form-group">
                                            <label for="cmnd">CMND</label>
                                            <input type="number" class="form-control" id="cmnd" name="cmnd" placeholder="Nhập CMND...">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Tên đọc giả</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên đọc giả...">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ...">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Chấp nhận</button>
                                    </div>
                                </div>
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
                    </script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->
@endsection
@push('scripts')
<script src="..\libs\jquery.repeater\jquery.repeater.min.js"></script>

<script src="..\js\pages\form-repeater.int.js"></script>

<script src="..\js\app.js"></script>
@endpush
