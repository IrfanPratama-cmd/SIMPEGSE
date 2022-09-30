@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/data-diri">Data Diri</a></li>
                    <li class="breadcrumb-item active">Data Keluarga</li>
                </ol>
            </div>
            <h2>Data Keluarga {{ $pegawai->nama_lengkap }}</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        

                @include('pegawai.keluarga.navbar')

                <h1>Data Keluarga {{ $pegawai->nama_lengkap }}</h1>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection