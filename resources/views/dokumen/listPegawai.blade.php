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
                    <li class="breadcrumb-item active">Data Dokumen</li>
                </ol>
            </div>
            <h2>Data Dokumen</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/dokumen" class="nav-link active">
                            List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokumenTabelPegawai" class="nav-link">
                            Tabel
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="app-search dropdown d-none d-lg-block col-4">
                    <form action="/cariDokListPegawai" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="caridok" value="{{ old('caridok') }}"  placeholder="Search Dokumen" id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
        
                @foreach($dokumen as $d)
                <div class="my-2">
                    <label for="dokumen">{{ $d->tanggal }}</label>
                    <ul class="list-group my-2">
                        <a href="/detailDokumen/{{  Crypt::encrypt($d->id) }}">
                         <li id="dokumen" class="list-group-item btn-primary d-flex justify-content-between align-items-center" >
                             {{$d->nama_dokumen}}
    
                         </li>   
                         </a> 
                     </ul>
                </div>
                @endforeach
                 <br><br>

                 {{ $dokumen->links() }}
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>


  <script>

  </script>

@endsection