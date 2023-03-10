@extends('layouts.app')
@section('title', 'Thống kê')
@section('content')
<style>
    #myChart {
        width: 100% !important;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Thống kê</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thống kê</li>
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

                            <h4 class="card-title mb-4">Số lượng sách</h4>

                            <div class="row text-center">
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $borrowedBookCount }}</h5>
                                    <p class="text-muted text-truncate">Đã cho mượn</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $remainingBookCount }}</h5>
                                    <p class="text-muted text-truncate">Còn lại</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-0">{{ $borrowedBookCount + $remainingBookCount }}</h5>
                                    <p class="text-muted text-truncate">Tổng</p>
                                </div>
                            </div>

                            <canvas id="myChart"></canvas>

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

</div>
<!-- END layout-wrapper -->

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

<!-- Chart JS -->
<script src="..\libs\chart.js\Chart.bundle.min.js"></script>
<script src="..\js\pages\chartjs.init.js"></script>

<!-- App js -->
<script src="..\js\app.js"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
            datasets: [{
                label: "Số lượng sách mượn",
                fill: !0,
                lineTension: .5,
                backgroundColor: "rgba(85, 110, 230, 0.2)",
                borderColor: "#556ee6",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "#556ee6",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#556ee6",
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [<?php foreach ($loanCardArray as $key => $loanCard) {
                            echo $loanCard . ",";
                        } ?>]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        max: <?= ($loanCardCount) ? ($loanCardCount) + 1 : 1; ?>,
                        min: 0,
                        stepSize: <?= ($loanCardCount) ? round(($loanCardCount) / 2) : 1; ?>
                    }
                }]
            },
            responsive: false
        }
    });
</script>
@endpush
