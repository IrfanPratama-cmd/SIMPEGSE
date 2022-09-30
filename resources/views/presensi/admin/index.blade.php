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
                        <a href="/data-presensi" class="nav-link active">
                            Hari ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/izinPegawai" class="nav-link">
                            Izin
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <h2>Presensi Hari {{ $tanggal }}</h2> <br>

                @if($tanggal == $sabtu || $tanggal == $minggu)

                    <h1 class="text-center">Hari Ini Libur !</h1> <br><br><br><br><br>

                @else

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
                            <th>Status Presensi</th>
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
                            @if($p->status == "Sekolah")
                                <td >{{ $p->status}} (Onsite)</td> 
                            @elseif($p->status == "Rumah") 
                                <td >{{ $p->status}} (WFH)</td> 
                            @elseif($p->status == "Alpha") 
                                <td >{{ $p->status}}</td> 
                            @endif
                            <td>
                                <!-- Switch-->
                                <div>
                                    <input type="checkbox" id="switch1" checked data-switch="success"/>
                                    <label for="switch1" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @foreach($belum as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->nama_lengkap }}</td>
                            <td>{{ $tanggal }}</td>
                            <td>Belum Presensi</td>
                            <td>Belum Presensi</td>
                            <td>Belum Presensi</td>
                            <td>
                                <form action="/alphaPegawai/{{ $b->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="keterangan" value="Alpha">
                                    <button class="btn btn-danger">Alpha</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $presensi->links() }} 
                
                @endif
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection