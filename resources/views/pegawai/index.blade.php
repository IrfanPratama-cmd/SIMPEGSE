@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Data Diri {{ $pegawai->nama_lengkap }}</h1>
<hr>
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            @if($pegawai2 >= 1)
                <div class="card border-success border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">Profile</h4>
                        <div class="d-grid">
                            <a href="/profilePegawai/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-success btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @else
                <div class="card border-secondary border">
                    <div class="card-body">
                        <h4 class="card-title text-center">Profile</h4>
                        <div class="d-grid">
                            <a href="/profilePegawai/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-secondary btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @endif
        </div> <!-- end col-->
    
        <div class="col-md-3">
            @if($ortu >= 1 && $anak >= 1)
                <div class="card border-success border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">Data Keluarga</h4>
                    <div class="d-grid">
                        <a href="/data-keluarga/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-success btn-sm">Button</a>
                    </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @else
                <div class="card border-secondary border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-secondary">Data Keluarga</h4>
                    <div class="d-grid">
                        <a href="/data-keluarga/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-secondary btn-sm">Button</a>
                    </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @endif
        </div> <!-- end col-->
    
        <div class="col-md-3">
            @if($pendidikan >= 1)
                <div class="card border-success border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">Riwayat Pendidikan</h4>
                        <div class="d-grid">
                            <a href="/pendidikan/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-success btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @else
                <div class="card border-secondary border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-secondary">Riwayat Pendidikan</h4>
                        <div class="d-grid">
                            <a href="/pendidikan/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-secondary btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @endif
        </div> <!-- end col-->
    
        <div class="col-md-3">
            @if($organisasi >= 1)
                <div class="card border-success border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">Riwayat Organisasi</h4>
                        <div class="d-grid">
                            <a href="/riwayatorganisasi/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-success btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @else
                <div class="card border-secondary border">
                    <div class="card-body">
                        <h4 class="card-title text-center text-secondary">Riwayat Organisasi</h4>
                        <div class="d-grid">
                            <a href="/riwayatorganisasi/{{Crypt::encrypt($pegawai->id) }}" class="btn btn-secondary btn-sm">Button</a>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            @endif
        </div> <!-- end col-->
    </div>
    </div>
</div>




@endsection