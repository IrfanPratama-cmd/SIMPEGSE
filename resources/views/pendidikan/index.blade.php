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
                    <li class="breadcrumb-item active">Data Pendidikan</li>
                </ol>
            </div>
            <h2>Data Pendidikan</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <h3>Riwayat Pendidikan</h3>
                <hr>    

                @foreach($pendidikan as $p)
                <ul class="list-group my-2 col-12">
                   <a href="/detailPendidikan/{{  Crypt::encrypt($p->id) }}">
                    <li class="list-group-item btn-primary d-flex justify-content-between align-items-center">
                        {{$p->nama_instansi}}
                    
                        <form action="/hapusPendidikan/{{  Crypt::encrypt($p->id) }}" method="post" class="d-flex col-1">
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

                <a href="/tambahPendidikan" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i>Tambah</a>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection