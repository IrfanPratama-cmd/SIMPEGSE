@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Absensi Pegawai</h1>
<hr>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        

                {{-- @include('absensi.navbar') --}}

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/absensi-pegawai" class="nav-link">
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/rekap-absenPegawai" class="nav-link active">
                            Rekap
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="row">
                    <h2>Total Absensi = {{ $absensi }}</h2>

                    <div class="col-xxl-3 col-lg-6">
                        <div class="card widget-flat bg-success text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Hadir</h2>
                                <h4 class="mt-3 mb-3">{{ $hadir }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-lg-6">
                        <div class="card widget-flat bg-warning text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-warning"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Ijin</h2>
                                <h4 class="mt-3 mb-3">{{ $ijin }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-lg-6">
                        <div class="card widget-flat bg-info text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-info"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Sakit</h2>
                                <h4 class="mt-3 mb-3">{{ $sakit }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-lg-6">
                        <div class="card widget-flat bg-danger text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-danger"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Alpha</h2>
                                <h4 class="mt-3 mb-3">{{ $alpha }}</h4>
                            </div>
                        </div>
                    </div>


            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection