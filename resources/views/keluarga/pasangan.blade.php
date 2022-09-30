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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Diri</a></li>
                    <li class="breadcrumb-item active">Data Keluarga</li>
                </ol>
            </div>
            <h2>Data Keluarga</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
        

                @include('keluarga.navbar')

                @foreach($pasangan as $p)
                <ul class="list-group my-2">
                    <a href="/detailPasangan/{{  Crypt::encrypt($p->id) }}">
                     <li class="list-group-item btn-primary d-flex justify-content-between align-items-center" style="hover:">
                         {{$p->nama_pasangan}}

                         <form action="/hapusPasangan/{{  Crypt::encrypt($p->id) }}" method="post" class="d-flex col-1">
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

                <a href="/tambahPasangan" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i>Tambah</a>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection