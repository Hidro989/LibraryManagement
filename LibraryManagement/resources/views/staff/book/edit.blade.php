
@extends('layouts.app')
            @section('title', 'Sửa sách')

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
                                    <h4 class="mb-0 font-size-18">Sửa sách</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý sách</a></li>
                                            <li class="breadcrumb-item active">Sửa sách</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Sửa sách</h4>
                                        @include('common.errors')
                                       
                                        <form class="outer-repeater" action="{{route('book.update', $book->isbn)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            
                                            <div  class="outer">
                                                <div  class="outer">
                                                    <div class="form-group" hidden>
                                                        <label for="isbn">ISBN</label>
                                                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Nhập mã ISBN..." value="{{$book->isbn}}">
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label for="bookname">Tên sách</label>
                                                        <input type="text" class="form-control" id="bookname" name="bookname" placeholder="Nhập tên sách..." value="{{$book->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="formrow-inputState">Thể loại</label>
                                                        <select id="formrow-inputState" class="form-control" name="typebook">
                                                            <option>Chọn thể loại...</option>
                                                            @if (!empty($types))
                                                                @foreach ($types as $type)
                                                                    @if ($type->id == $book->idTypeBook)
                                                                    <option selected value="{{$type->id}}">{{$type->name}}</option>
                                                                    @else
                                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                                    @endif
                                                                
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="author">Tác giả</label>
                                                        <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tên tác giả..." value="{{$book->author}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="publisher">Nhà xuất bản</label>
                                                        <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Nhập tên nhà xuất bản..." value="{{$book->publisher}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="number-input">Năm xuất bản</label>
                                                        <input class="form-control" type="number" min="1990"  value="{{$book->publishingYear}}" id="number-input" name="publisingYear">
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
                                <script>document.write(new Date().getFullYear())</script> © Skote.
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