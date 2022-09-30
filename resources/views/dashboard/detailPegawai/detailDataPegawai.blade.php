@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Data Diri Pegawai {{ $pegawai->nama_lengkap }}</h1>
<br>

<div class="row">
    <div class="col-md-3">
        <div class="card border-secondary border">
            <div class="card-body">
                <h4 class="card-title text-center">Profile</h4>
                <div class="d-grid">
                    <a href="/detailProfile/{{  Crypt::encrypt($pegawai->id) }}" class="btn btn-secondary btn-sm">Button</a>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card border-primary border">
            <div class="card-body">
                <h4 class="card-title text-center text-primary">Data Keluarga</h4>
               <div class="d-grid">
                   <a href="/data-keluarga" class="btn btn-primary btn-sm">Button</a>
               </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card border-success border">
            <div class="card-body">
                <h4 class="card-title text-center text-success">Riwayat Pendidikan</h4>
               
                <div class="d-grid">
                    <a href="/detailPendidikan/{{  Crypt::encrypt($pendidikan->id) }}" class="btn btn-success btn-sm">Button</a>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-md-3">
        <div class="card border-success border">
            <div class="card-body">
                <h4 class="card-title text-center text-success">Riwayat Organisasi</h4>
                <div class="d-grid">
                    <a href="javascript: void(0);" class="btn btn-success btn-sm">Button</a>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection