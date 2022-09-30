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
                        <a href="/data-presensi" class="nav-link">
                            Hari ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/izinPegawai" class="nav-link active">
                            Izin
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <h2>Data Izin Hari {{ $tanggal }}</h2>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->pegawai->nama_lengkap }}</td>
                            <td>{{ $i->tgl }}</td>
                            <td>{{ $i->keterangan }}</td>
                            {{-- <td>{{ $i->alasan }}</td> --}}
                            {{-- <td>{{ $i->bukti }}</td> --}}
                            <td><a href="/downloadBukti/{{ $i->bukti }}">{{ $i->bukti }}</a></td>
                            <td>{{ $i->status }}</td>
                            <td>
                                <form action="/terimaIzin/{{ $i->id }}" method="post" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="Diterima">
                                    <button class="btn btn-info">Terima</button>
                               </form>
                                <form action="/tolakIzin/{{ $i->id }}" method="post" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button class="btn btn-danger">Tolak</button>
                                </form>
                            </td>
                            {{-- <td>
                                <!-- Switch-->
                                <div>
                                    <input type="checkbox" id="switch1" checked data-switch="success"/>
                                    <label for="switch1" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                </div>
                            </td> --}}
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