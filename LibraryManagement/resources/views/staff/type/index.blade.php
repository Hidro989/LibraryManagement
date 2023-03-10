﻿@extends('layouts.app-staff')
@section('title', 'Thể loại')
@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Thể loại</h4>
                        <a href="{{route('type.create')}}" class="btn btn-primary">Thêm thể loại</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Quản lý thể loại</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" width="50%">ID</th>
                                            <th scope="col" colspan="2" width="50%">Tên thể loại</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($types))
                                        @foreach ($types as $type)
                                        <tr>
                                            <td>
                                                <div class="font-size-14 mb-1">
                                                    <span>
                                                        {{$type->id}}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{$type->name}}</a></h5>
                                            </td>

                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px-2">
                                                        <a href="{{url('/type/'.$type->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">

                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item px-2">
                                                        <form action="{{route('type.destroy', $type->id)}}" method="POST" data-toggle="tooltip" data-placement="top" title="Remove" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="bg-transparent border-0 ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif



                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 justify-content-center">
                                    {{$types->links()}}

                                </div>
                            </div>
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
<script src="..\js\app.js"></script>
@endpush
