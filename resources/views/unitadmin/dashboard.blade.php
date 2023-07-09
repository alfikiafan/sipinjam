@extends('layouts.user_type.auth')

@section('content')
@include('components.notifications')

<div class="row px-3">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('items.index') }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Items</p>
                                <h5 class="font-weight-bolder mb-0">{{ $totalItems }}</h5>
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
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('items.index', ['status' => 'available']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Items Available</p>
                                <h5 class="font-weight-bolder mb-0">{{ $itemsAvailable }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-check fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('items.index', ['status' => 'empty']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Empty Items</p>
                                <h5 class="font-weight-bolder mb-0">{{ $emptyItems }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-exclamation-circle fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('usages.index', ['status' => 'used']) }}">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Usages</p>
                                <h5 class="font-weight-bolder mb-0">{{ $activeUsagesCount }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-lg fa-chart-line opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'pending']) }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $pendingBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-hourglass-start fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'rejected']) }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rejected Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $rejectedBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-ban fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('bookings.index', ['status' => 'cancelled']) }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Cancelled Bookings</p>
                                <h5 class="font-weight-bolder mb-0">{{ $cancelledBookings }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-xmark fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('usages.index', ['status' => 'late']) }}">
            <div class="card h-100 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Late<br> Usages</p>
                                <h5 class="font-weight-bolder mb-0">{{ $lateUsagesCount }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-clock fa-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="row px-3 mt-5">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex flex-column h-100">
                        <h5 class="font-weight-bolder ps-3">Welcome,</h5>
                        <p class="mb-1 ps-3 text-sm">You are logged in as Unit Admin</p>
                        <p class="mb-1 ps-3 text-sm">Choose a menu below to get started:</p>
                        <div class="card my-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">Items</h6>
                                <p class="card-text text-sm mb-2 text-white">Manage the list of available items.</p>
                                <a href="{{ route('items.index') }}"
                                    class="text-primary font-weight-bold underline">See More</a>
                            </div>
                        </div>
                        <div class="card mb-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">Bookings</h6>
                                <p class="card-text text-sm mb-2 text-white">View and manage ongoing loans.</p>
                                <a href="{{ route('bookings.index') }}"
                                    class="text-primary font-weight-bold underline">See More</a>
                            </div>
                        </div>
                        <div class="card mb-3 overflow-hidden"
                            style="background-image: url('{{ asset('assets/img/curved2.jpg') }}');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body overflow-hidden position-relative border-radius-xl p-3">
                                <h6 class="card-title text-white">Usages</h6>
                                <p class="card-text text-sm mb-2 text-white">Monitor product usage and return
                                    history.</p>
                                <a href="{{ route('usages.index') }}"
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
                <h6>Bookings Request</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedBookings = $bookings->sortByDesc('created_at')->take(5);;
                    @endphp
                    @foreach ($sortedBookings as $booking)
                    <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i><img src="{{ asset($booking->user->photo) }}" class="avatar avatar-sm"
                                        alt="item-image"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm mb-0">{{ $booking->user->name }} | <span class="text-secondary">{{ $booking->user->email }}</span></h6>
                                <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $booking->item->name }}</span> | <span class="text-secondary">{{ $booking->created_at }}</span></p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row px-3 mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Bookings overview</h6>
                <p class="text-sm">This is overview of bookings in this year</p>
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
<div class="row px-3 my-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Active Usages</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedActiveUsages = $activeUsages->sortByDesc('created_at')->take(5);;
                    @endphp
                    @foreach ($sortedActiveUsages as $activeUsage)
                    <a href="{{ route('usages.show', ['usage' => $activeUsage->id]) }}">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i><img src="{{ asset($activeUsage->booking->user->photo) }}" class="avatar avatar-sm"
                                        alt="item-image"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm mb-0">{{ $activeUsage->booking->user->name }} | <span class="text-secondary">{{ $activeUsage->booking->user->email }}</span></h6>
                                <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $activeUsage->booking->item->name }}</span> | <span class="text-secondary">{{ $activeUsage->booking->start_date }}</span></p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Late Usages</h6>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    @php
                        $sortedLateUsages = $lateUsages->sortByDesc('created_at')->take(5);;
                    @endphp
                    @foreach ($sortedLateUsages as $lateUsage)
                    <a href="{{ route('usages.show', ['usage' => $lateUsage->id]) }}">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i><img src="{{ asset($lateUsage->booking->user->photo) }}" class="avatar avatar-sm"
                                    alt="item-image"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm mb-0">{{ $lateUsage->booking->user->name }} | <span class="text-secondary">{{ $lateUsage->booking->user->email }}</span></h6>
                                <p class="text-sm mt-1 mb-0"><span class="text-dark">{{ $lateUsage->booking->item->name }}</span> | <span class="text-secondary">{{ $lateUsage->booking->start_date }}</span></p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
const bookingChart = document.getElementById("booking-chart").getContext("2d");

const gradientStroke1 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

const gradientStroke2 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

var gradientStroke3 = bookingChart.createLinearGradient(0, 230, 0, 50);
gradientStroke3.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke3.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke3.addColorStop(0, 'rgba(20,23,39,0)');

// Mendapatkan tanggal 12 bulan terakhir
const currentDate = new Date();
let labels = [];
for (let i = 11; i >= 0; i--) {
    const date = new Date(currentDate.getFullYear(), currentDate.getMonth() - i, 1);
    const month = date.toLocaleString('default', { month: 'short' });
    labels.push(month);
}

new Chart(bookingChart, {
    type: "line",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Booking Requests",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#cb0c9f",
                backgroundColor: gradientStroke1,
                fill: true,
                data: {!! json_encode($bookingRequestsData) !!},
                maxBarThickness: 6,
                pointRadius: 0
            },
            {
                label: "Approved Bookings",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#3A416F",
                backgroundColor: gradientStroke2,
                fill: true,
                data: {!! json_encode($approvedBookingsData) !!},
                maxBarThickness: 6,
                pointRadius: 0
            },
            {
                label: "Returned Bookings",
                tension: 0.4,
                borderWidth: 3,
                borderColor: "#4a7c83",
                backgroundColor: gradientStroke3,
                fill: true,
                data: {!! json_encode($usagesReturnedData) !!},
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