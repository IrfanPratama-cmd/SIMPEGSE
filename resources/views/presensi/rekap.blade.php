@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Presensi Pegawai</h1>
<hr>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        

                {{-- @include('absensi.navbar') --}}

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/presensi" class="nav-link">
                            Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/ijin" class="nav-link">
                            Izin
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/rekapPresensi" class="nav-link active">
                           Rekap
                      </a>
                    </li>
                </ul> <!-- end nav-->

                <div class=" d-lg-block col-4">
                    <form action="/presensiBulan" method="GET">
                        <div class="input-group">
                            <select class="form-select" name="bulan" id="example-select">
                                <option selected disabled>Pilih Bulan</option>
                                  <option value="01">Januari</option>
                                  <option value="02">Februari</option>
                                  <option value="03">Maret</option>
                                  <option value="04">April</option>
                                  <option value="05">Mei</option>
                                  <option value="06">Juni</option>
                                  <option value="07">Juli</option>
                                  <option value="08">Agustus</option>
                                  <option value="09">September</option>
                                  <option value="10">Oktober</option>
                                  <option value="11">November</option>
                                  <option value="12">Desember</option>
                              </select>
                              <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div><br>


                <div class="row">
                    <h2>Total Presensi = {{ $totalpresensi }}</h2>

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
                                <h2 class=" mt-0" title="Customers">Izin</h2>
                                <h4 class="mt-3 mb-3">{{ $izin }}</h4>
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

                <br><br>

                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal</th>
                            <th>Jam Presensi</th>
                            <th>Keterangan</th>
                            <th>Active?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->tgl }}</td>
                            <td>{{ $p->jam_presensi }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>
                                <!-- Switch-->
                                <div>
                                    <input type="checkbox" id="switch1" checked data-switch="success"/>
                                    <label for="switch1" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
                {{ $presensi->links() }}               
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection