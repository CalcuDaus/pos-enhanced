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
                            <a href="{{ url('/dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Report
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        @foreach ($accounts as $account)
            <div class="col-md-4 col-sm-6">
                <div class="card statistics-card-1 overflow-hidden">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $account['image'] ) }}" alt="img"
                            class="img-fluid img-bg pt-3 pe-3" style="width: 120px" />

                        <h5 class="mb-4">
                            Saldo {{ $account['account_name'] }} Awal Hari Ini
                        </h5>

                        <div class="d-flex align-items-center mt-3">
                            <h3 class="f-w-300 d-flex align-items-center mb-0">
                                Rp. {{ number_format($account['begin_balance'], 0, ',', '.') }}
                            </h3>
                            <span
                                class="badge 
                                @if ($account['percentage'] >= 0) bg-light-success 
                                @else bg-light-danger @endif 
                                ms-2">
                                {{ $account['percentage'] }}%
                            </span>
                        </div>

                        <p class="text-muted mb-2 text-sm mt-3">
                            You made an extra {{ number_format($account['difference'], 0, ',', '.') }} this daily
                        </p>

                        <div class="progress" style="height: 7px">
                            <div class="progress-bar 
                                @if ($account['percentage'] >= 0) bg-success 
                                @else bg-danger @endif"
                                role="progressbar" style="width: {{ abs($account['percentage']) }}%"
                                aria-valuenow="{{ round($account['percentage']) }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- [ Main Content ] end -->
@endsection
