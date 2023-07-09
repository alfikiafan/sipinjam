@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-2 mb-4">
            <a href="{{ route('units.index') }}">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Units</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalUnits }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-lg fa-building opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-2 mb-4">
            <a href="{{ route('unitadmins.index') }}">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Unit Admin</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalUnitadmins }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-lg fa-user-cog opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-1 mb-4">
            <a href="{{ route('categories.index') }}">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Categories</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $totalCategories }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-lg fa-list-alt opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-2 mb-4">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Borrower</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalUsers }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-user opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-1 mb-4">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Items</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalAllItems }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-cubes opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-1 mb-4">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Bookings<br> in This Month</p>
                                <h5 class="font-weight-bolder mb-0">{{ $currentMonthBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-calendar-alt opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex flex-column h-100">
                            <h5 class="font-weight-bolder ps-3">Welcome,</h5>
                            <p class="mb-1 ps-3 text-sm">You are logged in as Administrator</p>
                            <p class="mb-1 ps-3 text-sm">Choose a menu below to get started:</p>
                            <div class="card my-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Categories</h6>
                                    <p class="card-text text-sm mb-2 text-white">Manage the list of Categories.</p>
                                    <a href="{{ route('categories.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                            <div class="card mb-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Unit Admin</h6>
                                    <p class="card-text text-sm mb-2 text-white">See who is the admin for certain unit.</p>
                                    <a href="{{ route('unitadmins.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                            <div class="card mb-3 overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                    <h6 class="card-title text-white">Unit</h6>
                                    <p class="card-text text-sm mb-2 text-white">Manage the list of Units.</p>
                                    <a href="{{ route('units.index') }}"
                                        class="text-primary font-weight-bold underline">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Manage Your Activities</h6>
                </div>
                <div class="card-body">
                    <div class="timeline timeline-one-side">
                        <a href="{{ route('categories.index') }}">
                            <div class="timeline-block mb-3">
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $randomNumber }} Categories need to be updated</h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">Update Now</span></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="timeline timeline-one-side">
                        <a href="{{ route('categories.index') }}">
                            <div class="timeline-block mb-3">
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $randomNumber2 }} Categories need to be Added</h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">Add Now</span></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="timeline timeline-one-side">
                        <a href="{{ route('units.index') }}">
                            <div class="timeline-block mb-3">
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $randomNumber3 }} Unit need to be updated</h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">Update Now</span></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="timeline timeline-one-side">
                        <a href="{{ route('units.index') }}">
                        <div class="timeline-block mb-3">
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm mb-0">{{ $randomNumber4 }} Unit need to be Added</h6>
                                    <p class="text-sm mt-1 mb-0"><span class="text-dark">Add Now</span></p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Bookings Overview</h6>
                    <p class="text-sm">This is overview of all bookings in this year</p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="booking-chart" class="chart-canvas" height="600" width="1780"
                            style="display: block; box-sizing: border-box; height: 300px; width: 890px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var bookingChart = document.getElementById("booking-chart").getContext("2d");

var gradientStroke1 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

var gradientStroke2 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

var gradientStroke3 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke3.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke3.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke3.addColorStop(0, 'rgba(20,23,39,0)');

// Mendapatkan tanggal 12 bulan terakhir
var currentDate = new Date();
var labels = [];
for (var i = 11; i >= 0; i--) {
    var date = new Date(currentDate.getFullYear(), currentDate.getMonth() - i, 1);
    var month = date.toLocaleString('default', { month: 'short' });
    labels.push(month);
}

new Chart(bookingChart, {
    type: "line",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Booking Request",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#cb0c9f",
                backgroundColor: gradientStroke1,
                fill: true,
                data: {!! json_encode($dataBookingsRequest) !!},
                maxBarThickness: 6,
                pointRadius: 0
            },
            {
                label: "Bookings Approved",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#3A416F",
                backgroundColor: gradientStroke2,
                fill: true,
                data: {!! json_encode($dataBookingsApproved) !!},
                maxBarThickness: 6,
                pointRadius: 0
            },
            {
                label: "Items Returned",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#4a7c83",
                backgroundColor: gradientStroke3,
                fill: true,
                data: {!! json_encode($dataUsagesReturned) !!},
                maxBarThickness: 6,
                pointRadius: 0
            }
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#b2b9bf',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#b2b9bf',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});

</script>

@endsection