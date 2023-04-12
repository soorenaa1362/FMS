@extends('admin.layouts.admin')

@section('script')
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

    </script>
@endsection

@section('title')
    reports: day
@endsection

@section('content')
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> گزارش روزانه </h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            گزارش
        </a>
    </div> --}}

    <div class="row">
        <!-- Latest Today Incomes -->
        @if (blank($latestIncomes))
        <div class="col-xl-12 col-md-12 p-3 bg-white">
            <h5 class="mr-5 mt-2 mb-4">
                امروز هیچ درآمدی ثبت نشده است .
            </h5>
        </div> <!-- col-xl-12 -->
        @else
            <div class="col-xl-12 col-md-12 p-3 bg-white">
                <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                    <h5 class="font-weight-bold mb-1 mb-md-0">آخرین درآمدهای امروز</h5>
                </div>
                <div>
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                                <th>حساب</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestIncomes as $key => $income)
                                <tr>
                                    <td>
                                        <a href="{{ route('incomes.show', ['income' => $income->id]) }}">{{ $income->title }}</a>
                                    </td>
                                    <td>{{ number_format($income->amount) }} تومان</td>
                                    <td>
                                        {{ $income->card->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- col-xl-12 -->
        @endif

        <!-- Latest Today Costs -->
        @if (blank($latestCosts))
            <div class="col-xl-12 col-md-12 p-3 bg-white">
                <h5 class="mr-5 mt-2 mb-4">
                    امروز هیچ خرجکردی ثبت نشده است .
                </h5>
            </div> <!-- col-xl-12 -->
        @else
            <div class="col-xl-12 col-md-12 p-3 bg-white">
                <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                    <h5 class="font-weight-bold mb-1 mb-md-0">آخرین خرجکردهای امروز</h5>
                </div>
                <div>
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                                <th>حساب</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costs as $key => $cost)
                                <tr>
                                    <td>
                                        <a href="{{ route('costs.show', ['cost' => $cost->id]) }}">{{ $cost->title }}</a>
                                    </td>
                                    <td>{{ number_format($cost->amount) }} تومان</td>
                                    <td>
                                        {{ $cost->card->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- col-xl-12 -->
        @endif
    </div> <!-- row -->

    <!-- Content Row -->
    <div class="row">

        <!-- Reports (Incomes) -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-right-success shadow h-100 py-2">
                <div class="card-body">
                    <a href="{{ route('reports.day.incomes') }}" style="text-decoration: none;">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="font-weight-bold text-success">
                                    درآمد
                                </h5>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                    <hr>
                    <h6>{{ number_format(1648195) }} تومان</h6>
                </div>
            </div>
        </div>

        <!-- Reports (Costs) -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-right-primary shadow h-100 py-2">
                <div class="card-body">
                    <a href="#" style="text-decoration: none;">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="font-weight-bold text-primary">
                                    خرجکرد
                                </h5>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                    <hr>
                    <h6>{{ number_format(1648195) }} تومان</h6>
                </div>
            </div>
        </div>

    </div> <!-- Row -->

@endsection
