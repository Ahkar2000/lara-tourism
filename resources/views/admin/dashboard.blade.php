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
                                <div class="ct-bar-chart m-t-30"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Packages Per Bookings</h4>
                            </div>
                            <div class="card-body">
                                <div class="ct-pie-chart"></div>
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
        
    (function ($) {
        "use strict";

        var data = {
            labels: JSON.parse(`<?php echo $data3; ?>`),
            series: JSON.parse(`<?php echo $data2; ?>`)
        };

        var options = {
            labelInterpolationFnc: function (value) {
                return value[0]
            }
        };

        var responsiveOptions = [
    ['screen and (min-width: 640px)', {
                chartPadding: 30,
                labelOffset: 100,
                labelDirection: 'explode',
                labelInterpolationFnc: function (value) {
                    return value;
                }
    }],
    ['screen and (min-width: 1024px)', {
                labelOffset: 80,
                chartPadding: 20
    }]
    ];

        new Chartist.Pie('.ct-pie-chart', data, options, responsiveOptions);

        var data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                JSON.parse(`<?php echo $data; ?>`),
            ]
        };

        var options = {
            seriesBarDistance: 10
        };

        var responsiveOptions = [
        ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
    }]
    ];

        new Chartist.Bar('.ct-bar-chart', data, options, responsiveOptions);




    })(jQuery);
    

    </script>
@endpush