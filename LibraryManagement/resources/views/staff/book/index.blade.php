@extends('layouts.app')
            @section('title', 'Sách')
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
                                    <h4 class="mb-0 font-size-18">Sách</h4>
                                    <a href="{{route('book.create')}}" class="btn btn-primary">Thêm sách</a>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý sách</a></li>
                                            <li class="breadcrumb-item active">Sách</li>
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
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">ISBN</th>
                                                        <th scope="col">Tên sách</th>
                                                        <th scope="col">Thể loại</th>
                                                        <th scope="col">Tác giả</th>
                                                        <th scope="col">Nhà xuất bản</th>
                                                        <th scope="col">Năm xuất bản</th>
                                                        <th scope="col" colspan="2">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($books as $book)
                                                    <tr>
                                                        <td>
                                                            <div class="font-size-14 mb-1">
                                                                <span>
                                                                    {{$book->isbn}}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{$book->name}}</a></h5>
                                                        </td>
                                                        
                                                        <td>
                                                            <div>
                                                                @foreach ($types as $type)
                                                                    @if ($type->id == $book->idTypeBook)
                                                                    <b class="badge badge-soft-primary font-size-11 m-1">{{$type->name}}</b>
                                                                    @endif
                                                                @endforeach
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$book->author}}
                                                        </td>
                                                        <td>
                                                            {{$book->publisher}}
                                                        </td>
                                                        <td>
                                                            {{$book->publishingYear}}
                                                        </td>
                                                        <td>
                                                            {{($book->status == 1) ? 'Đã mượn' : "Chưa mượn"}}
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                                <li class="list-inline-item px-2">
                                                                    <a href="{{url('/book/'.$book->isbn)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        
                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                                                                                                                        </a>
                                                                    
                                                                </li>
                                                                <form action="{{route('book.destroy', $book->isbn)}}" method="POST" data-toggle="tooltip" data-placement="top" title="Remove" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="bg-transparent border-0 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>    
                                                                    </button>    
                                                                </form>  
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                   

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {{$books->links()}}
                                                {{-- <ul class="pagination pagination-rounded justify-content-center mt-4">
                                                    <li class="page-item disabled">
                                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="#" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link">5</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                                    </li>
                                                </ul> --}}
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
            <script src="..\js\app.js"></script>
            @endpush