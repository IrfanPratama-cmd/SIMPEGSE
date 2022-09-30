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
                    <li class="breadcrumb-item active">Riwayat Diklat</li>
                </ol>
            </div>
            <h2>Riwayat Diklat</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/riwayatorganisasi" class="nav-link">
                            Riwayat Organisasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/diklat" class="nav-link active">
                            Riwayat Diklat
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="/seminar" class="nav-link">
                           Riwayat Seminar
                      </a>
                  </li>
                </ul> <!-- end nav-->
                
                <h3>Riwayat Diklat</h3>   

                @foreach($diklat as $d)
                <ul class="list-group my-2 col-12">
                   <a href="/detailDiklat/{{  Crypt::encrypt($d->id) }}">
                    <li class="list-group-item btn-primary d-flex justify-content-between align-items-center">
                        {{$d->nama_diklat}}
                    
                        <form action="/hapusDiklat/{{  Crypt::encrypt($d->id) }}" method="post" class="d-flex col-1">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>    
                    </li>   
                    </a> 
                    
                </ul>

                @endforeach

                <br><br>

                <a href="/tambahDiklat" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i>Tambah</a>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection