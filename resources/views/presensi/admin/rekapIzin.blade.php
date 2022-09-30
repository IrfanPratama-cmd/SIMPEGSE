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
                        <a href="/rekapPresensiHarian" class="nav-link">
                            Rekap Harian
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/rekapIzin" class="nav-link active">
                           Rekap Izin
                      </a>
                    </li>
                </ul> <!-- end nav-->

                <div class=" d-lg-block col-4">
                    <form action="/bulanIzin" method="GET">
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

                {{-- @if($tanggal == 08)
                    <h2>Data Izin Bulan Agustus</h2>
                @elseif($tanggal == 09)
                    <h2>Data Izin Bulan September</h2>
                @elseif($tanggal == 10)
                    <h2>Data Izin Bulan Oktober</h2>
                @elseif($tanggal == 11)
                    <h2>Data Izin Bulan November</h2>
                @elseif($tanggal == 12)
                    <h2>Data Izin Bulan Desember</h2>
                @else --}}
                    <h2>Data Izin Bulan {{ $tanggal }}</h2>
                {{-- @endif --}}

                <table class="table table-centered mb-0">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            {{-- <th>Alasan</th> --}}
                            <th>Bukti</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->pegawai->nama_lengkap }}</td>
                            <td>{{ $i->tgl }}</td>
                            <td>{{ $i->keterangan }}</td>
                            <td><a href="/downloadBukti/{{ $i->bukti }}">{{ $i->bukti }}</a></td>
                            <td>{{ $i->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{ $izin->links() }}
                </table>                  
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection