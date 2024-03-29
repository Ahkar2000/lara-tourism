@extends('admin.layouts.admin')

@section('content')

<!-- /# sidebar -->

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-list color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Bookings</div>
                                    <div class="stat-digit">{{ $total }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Users</div>
                                    <div class="stat-digit">{{ $users->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-package color-pink border-pink"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Packages</div>
                                    <div class="stat-digit">{{ $packageTotal }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-email color-danger border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Inquiries</div>
                                    <div class="stat-digit">{{ $inquiries->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Yearly Report of Booking Lists</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="ct-bar-chart m-t-30"></div> --}}
                                <canvas id="areaChart" height="190px"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Packages Per Bookings</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="ct-pie-chart"></div> --}}
                                <canvas id="pieChart" height="190px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
@push('script')
    <script>
    $('.stat-digit').counterUp({
        'delay': 10,
        'time': 1000
    });

    var xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var yValues = JSON.parse(`<?php echo $data; ?>`);
    var barColors = "#1e7145";

    new Chart("areaChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
        options: {
        legend: {display: false},
        title: {
        display: false,
        }
    }
    });

    var pieLabel = JSON.parse(`<?php echo $data2; ?>`)
    var pieData = JSON.parse(`<?php echo $data3; ?>`)

    var barColorsPie = ["#b91d47","#c3a5b4","#00aba9","#2b5797","#e8c3b9","#1e7145","#201923","#2f2aa0","#b732cc","#632819","#772b9d","#5d4c86"];

    new Chart("pieChart", {
    type: "pie",
    data: {
        labels: pieLabel,
        datasets: [{
        backgroundColor: barColorsPie,
        data: pieData
        }]
    },
    options: {
        title: {
        display: false,
        }
    }
    });
        
    // (function ($) {
    //     "use strict";

    //     var pieLabel = JSON.parse(`<?php echo $data2; ?>`)
    //     var pieData = JSON.parse(`<?php echo $data3; ?>`)

    //     for(let i=0; i<pieData.length; i++){
    //         if(pieData[i] == 0){
    //             pieData.splice(i,1)
    //             pieLabel.splice(i,1)
    //         }
    //     }

    //     var data = {
    //         labels: pieLabel,
    //         series: pieData
    //     };

    //     var options = {
    //         labelInterpolationFnc: function (value) {
    //             return value[0]
    //         }
    //     };

    //     var responsiveOptions = [
    //         ['screen and (min-width: 640px)', {
    //                     chartPadding: 30,
    //                     labelOffset: 100,
    //                     labelDirection: 'explode',
    //                     labelInterpolationFnc: function (value) {
    //                         return value;
    //                     }
    //         }],
    //         ['screen and (min-width: 1024px)', {
    //                     labelOffset: 80,
    //                     chartPadding: 20
    //         }]
    //     ];

    //     new Chartist.Pie('.ct-pie-chart', data, options, responsiveOptions);

    //     var data2 = {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    //         series: [
    //             JSON.parse(`<?php echo $data; ?>`),
    //         ]
    //     };

    //     var options = {
    //         seriesBarDistance: 10
    //     };

    //     var responsiveOptions = [
    //     ['screen and (max-width: 640px)', {
    //             seriesBarDistance: 5,
    //             axisX: {
    //                 labelInterpolationFnc: function (value) {
    //                     return value[0];
    //                 }
    //             }
    // }]
    // ];

    // new Chartist.Bar('.ct-bar-chart', data2, options, responsiveOptions);



    // })(jQuery);
    

    </script>
@endpush
