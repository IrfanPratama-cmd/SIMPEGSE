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
                        <a href="/rekapPresensiAdmin" class="nav-link">
                            Rekap Bulanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/rekapPresensiHarian" class="nav-link active">
                            Rekap Harian
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/rekapIzin" class="nav-link">
                           Rekap Izin
                      </a>
                    </li>
                </ul> <!-- end nav-->

                <h2>Presensi Tanggal {{ $hari }}</h2> <br>

                <div class=" d-lg-block col-4">
                    <form action="/cariPresensiHarian" method="GET">
                        <div class="input-group">
                            <input type="date" name="hari" class="form-control" id="">
                              <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div><br>

                <div class="row">
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card widget-flat bg-success text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Jumlah Pegawai</h2>
                                <h4 class="mt-3 mb-3">{{ $pegawai }}</h4>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card widget-flat bg-warning text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-warning"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Presensi Hari Ini</h2>
                                <h4 class="mt-3 mb-3">{{ $pegawaiPresensi }}</h4>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card widget-flat bg-info text-white">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon bg-white text-info"></i>
                                </div>
                                <h2 class=" mt-0" title="Customers">Belum Presensi</h2>
                                <h4 class="mt-3 mb-3">{{ $blmPresensi }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                

                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Pegawai</th>
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
                            <td>{{ $p->pegawai->nama_lengkap }}</td>
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