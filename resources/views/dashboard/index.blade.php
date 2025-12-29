@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../dashboard/index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Home
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <div class="row g-3">
        <div class="col-xl-4 col-md-6">
            <div class="card statistics-card-1 overflow-hidden h-100">
                <div class="card-body">
                    <img src="{{ asset('assets/images/widget/img-status-4.svg') }}" alt="img"
                        class="img-fluid img-bg" />
                    <h5 class="mb-4">Penjualan Hari Ini</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                            Rp. {{ number_format($todaySummary['incomeToday'][0]->total, 0, ',', '.') ?? 0 }}
                        </h3>
                        <span class="badge bg-light-success ms-2">36%</span>
                    </div>
                    <p class="text-muted mb-2 text-sm mt-3">
                        You made an extra 35,000 this daily
                    </p>
                    <div class="progress" style="height: 7px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card statistics-card-1 overflow-hidden h-100">
                <div class="card-body">
                    <img src="{{ asset('assets/images/widget/img-status-5.svg') }}" alt="img"
                        class="img-fluid img-bg" />
                    <h5 class="mb-4">Pengeluaran Hari Ini</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="f-w-300 d-flex align-items-center m-b-0">
                            Rp. {{ number_format($todaySummary['expenseToday'][0]->total, 0, ',', '.') ?? 0 }}
                        </h3>
                        <span class="badge bg-light-danger ms-2">20%</span>
                    </div>
                    <p class="text-muted mb-2 text-sm mt-3">
                        You made an extra 35,000 this Day
                    </p>
                    <div class="progress" style="height: 7px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card statistics-card-1 overflow-hidden bg-brand-color-3 h-100">
                <div class="card-body">
                    <img src="{{ asset('assets/images/widget/img-status-6.svg') }}" alt="img"
                        class="img-fluid img-bg" />
                    <h5 class="mb-4 text-white">Rata - Rata minggu ini</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">
                            Rp.
                            {{ number_format($todaySummary['averageIncome'][0]->total / 7, 0, ',', '.') ?? 0 }}
                        </h3>
                    </div>
                    <p class="text-white text-opacity-75 mb-2 text-sm mt-3">
                        You made an extra 35,000 this Daily
                    </p>
                    <div class="progress bg-white bg-opacity-10" style="height: 7px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card statistics-card-1 overflow-hidden bg-primary h-100">
                <div class="card-body">
                    <img src="{{ asset('assets/images/widget/img-status-7.svg') }}" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4 text-white">Total Titipan</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">
                            Rp. {{ number_format($totalDeposits, 0, ',', '.') }}
                        </h3>
                    </div>
                    <p class="text-white text-opacity-75 mb-2 text-sm mt-3">
                        Total uang titipan pelanggan
                    </p>
                    <div class="progress bg-white bg-opacity-10" style="height: 7px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card statistics-card-1 overflow-hidden bg-success h-100">
                <div class="card-body">
                    <img src="{{ asset('assets/images/widget/img-status-8.svg') }}" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4 text-white">Total Uang</h5>
                    <div class="d-flex align-items-center mt-3">
                        <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">
                            Rp. {{ number_format($totalMoney, 0, ',', '.') }}
                        </h3>
                    </div>
                    <p class="text-white text-opacity-75 mb-2 text-sm mt-3">
                        Total saldo di semua rekening
                    </p>
                    <div class="progress bg-white bg-opacity-10" style="height: 7px">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Grafik Tahun 2025</h5>
                    <div class="dropdown">
                        <a class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none" href="#"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons-two-tone f-18">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Edit</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row justify-content-center g-3 text-center mb-3">
                        <div class="col-6">
                            <div class="overview-product-legends">
                                <p class="text-muted mb-1"><span>Pendapatan</span></p>
                                <h4 class="mb-0">Rp. {{ number_format($lastYearData['incomeDataTotal'], 2) }}</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="overview-product-legends">
                                <p class="text-muted mb-1"><span>Pengeluaran</span></p>
                                <h4 class="mb-0">Rp. {{ number_format($lastYearData['expenseDataTotal'], 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="yearly-summary-chart">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5>Grafik 7 Hari Terakhir </h5>
                    <div class="dropdown">
                        <a class="avtar avtar-xs btn-link-secondary dropdown-toggle arrow-none" href="#"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons-two-tone f-18">more_vert</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item" href="#">View</a>
                            <a class="dropdown-item" href="#">Edit</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row justify-content-center g-3 text-center mb-3">
                        <div class="col-6">
                            <div class="overview-product-legends">
                                <p class="text-muted mb-1"><span>Pendapatan</span></p>
                                <h4 class="mb-0">Rp. {{ number_format($dailyData['incomeDataTotal'], 2) }}</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="overview-product-legends">
                                <p class="text-muted mb-1"><span>Pengeluaran</span></p>
                                <h4 class="mb-0">Rp. {{ number_format($dailyData['expenseDataTotal'], 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="daily-summary-chart">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- [ Main Content ] end -->
    <script>
        const lastYearData = @json($lastYearData);
        const dailyData = @json($dailyData);
    </script>
@endsection
