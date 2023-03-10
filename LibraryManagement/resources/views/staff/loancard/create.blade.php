@extends('layouts.app-staff')
@section('title', 'Tạo thẻ mượn')

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
                        <h4 class="mb-0 font-size-18">Tạo thẻ mượn</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('loancard.index') }}">Quản lý thẻ mượn</a></li>
                                <li class=" breadcrumb-item active">Tạo thẻ mượn</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Tạo thẻ mượn</h4>
                            @include('common.errors')

                            <form class="outer-repeater" action="{{route('loancard.store')}}" method="POST">
                                @csrf
                                <div class="outer">
                                    <div class="outer">

                                        <div class="form-group">
                                            <label for="formrow-inputState">Đọc giả</label>
                                            <select id="formrow-inputState" class="form-control" name="reader">
                                                <option selected>Chọn đọc giả...</option>
                                                @if (!empty($readers))
                                                @foreach ($readers as $reader)
                                                <option value="{{$reader->cmnd}}">{{$reader->name}}({{$reader->cmnd}})</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="formrow-inputState">Sách</label>
                                            <select id="formrow-inputState" class="form-control" name="book">
                                                <option selected>Chọn sách...</option>
                                                @if (!empty($books))
                                                @foreach ($books as $book)
                                                <option value="{{$book->isbn}}">{{$book->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Ngày mượn</label>
                                            <div class="input-daterange input-group">
                                                <input type="date" class="form-control" placeholder="Start Date" name="dateStart">
                                                <input type="date" class="form-control" placeholder="End Date" name="dateEnd">
                                            </div>
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
<script src="..\libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>
<script src="..\libs\jquery.repeater\jquery.repeater.min.js"></script>

<script src="..\js\pages\form-repeater.int.js"></script>

<script src="..\js\app.js"></script>
@endpush
