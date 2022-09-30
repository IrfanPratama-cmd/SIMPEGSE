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
                    <li class="breadcrumb-item"><a href="/detailPegawai/{{  Crypt::encrypt($pegawai->id) }}">Detail Pegawai</a></li>
                    <li class="breadcrumb-item active">Riwayat Seminar</li>
                </ol>
            </div>
            <h2>Riwayat Seminar {{ $pegawai->nama_lengkap }}</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/riwayatorganisasi/{{Crypt::encrypt($pegawai->id) }}" class="nav-link">
                            Riwayat Organisasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/diklat/{{Crypt::encrypt($pegawai->id) }}" class="nav-link">
                            Riwayat Diklat
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/seminar/{{Crypt::encrypt($pegawai->id) }}" class="nav-link active">
                           Riwayat Seminar
                      </a>
                  </li>
                </ul> <!-- end nav-->
                
                @foreach($seminar as $s)
                <ul class="list-group my-2 col-12">
                   <a href="/detailSeminarPegawai/{{  Crypt::encrypt($s->id) }}">
                    <li class="list-group-item btn-primary d-flex justify-content-between align-items-center">
                        {{$s->nama_seminar}}
                    </li>   
                    </a> 
                    
                </ul>

                @endforeach

                <br><br>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection