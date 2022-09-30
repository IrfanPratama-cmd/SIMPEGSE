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
                        <a href="/absensi-pegawai" class="nav-link active">
                            Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/rekap-absenPegawai" class="nav-link">
                            Rekap
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="row">
                    @foreach($absensi as $a)
                    <div class="col-md-3">
                        @if( $a->keterangan == "Hadir")
                        <div class="card border-success border">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $a->TMabsen->hari }},  {{ $a->TMabsen->tanggal }}</h4>
                                <p class="text-center">{{ $a->TMabsen->jam_mulai }} - {{ $a->TMabsen->jam_akhir }}</p>
                                <p class="text-center">Keterangan : {{ $a->keterangan }}</p>
                                <div class="d-grid">
                                    <a href="/detailAbsen/{{ Crypt::encrypt($a->id) }}" class="btn btn-success btn-sm">Detail</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                        
                        @elseif($a->keterangan == "Sakit")
                        <div class="card border-warning border">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $a->TMabsen->hari }},  {{ $a->TMabsen->tanggal }}</h4>
                                <p class="text-center">{{ $a->TMabsen->jam_mulai }} - {{ $a->TMabsen->jam_akhir }}</p>
                                <p class="text-center">Keterangan : {{ $a->keterangan }}</p>
                                <div class="d-grid">
                                    <a href="/detailAbsen/{{ Crypt::encrypt($a->id) }}" class="btn btn-warning btn-sm">Detail</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                
                        @elseif($a->keterangan == "Ijin")
                        <div class="card border-warning border">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $a->TMabsen->hari }},  {{ $a->TMabsen->tanggal }}</h4>
                                <p class="text-center">{{ $a->TMabsen->jam_mulai }} - {{ $a->TMabsen->jam_akhir }}</p>
                                <p class="text-center">Keterangan : {{ $a->keterangan }}</p>
                                <div class="d-grid">
                                    <a href="/detailAbsen/{{ Crypt::encrypt($a->id) }}" class="btn btn-warning btn-sm">Detail</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                
                        @elseif($a->keterangan == "Alpha")
                        <div class="card border-danger border">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $a->TMabsen->hari }},  {{ $a->TMabsen->tanggal }}</h4>
                                <p class="text-center">{{ $a->TMabsen->jam_mulai }} - {{ $a->TMabsen->jam_akhir }}</p>
                                <p class="text-center">Keterangan : {{ $a->keterangan }}</p>
                                <div class="d-grid">
                                    <a href="/detailAbsen/{{ Crypt::encrypt($a->id) }}" class="btn btn-danger btn-sm">Detail</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                
                        @else
                        <div class="card border-secondary border">
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $a->TMabsen->hari }},  {{ $a->TMabsen->tanggal }}</h4>
                                <p class="text-center">{{ $a->TMabsen->jam_mulai }} - {{ $a->TMabsen->jam_akhir }}</p>
                                <p class="text-center">Keterangan : {{ $a->keterangan }}</p>
                                <div class="d-grid">
                                    <a href="/absen/{{ Crypt::encrypt($a->id) }}" class="btn btn-secondary btn-sm">Absen</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                        @endif
                    </div> <!-- end col-->
                    @endforeach

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection