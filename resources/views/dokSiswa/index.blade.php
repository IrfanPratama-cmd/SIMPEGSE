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
            <h2>Data Dokumen Pegawai</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="/dokSiswa" class="nav-link active">
                            List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokTabelSiswa" class="nav-link">
                            Tabel
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="app-search dropdown d-none d-lg-block col-4">
                    <form action="/cariDokList" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="caridok" value="{{ old('caridok') }}"  placeholder="Search Dokumen" id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div> <br>

                <a href="/tambahDokSiswa" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i>Tambah</a>
        
                @foreach($dokumen as $d)
                <div class="my-2">
                    <label for="dokumen">Angkatan {{ $d->angkatan->angkatan }}</label>
                    <ul class="list-group my-2">
                        <a href="/allDokumen/{{  Crypt::encrypt($d->id) }}">
                         <li id="dokumen" class="list-group-item btn-primary d-flex justify-content-between align-items-center" >
                             {{$d->nama_dokumen}}
    
                             <form action="/hapusDokumenSiswa/{{  Crypt::encrypt($d->id) }}" method="post" class="d-flex col-1">
                                @method('delete')
                                @csrf
                                <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                                  </button>
                              </form>  
                         </li>   
                         </a> 
                     </ul>
                </div>
                @endforeach
                 <br><br>

                {{ $dokumen->links() }}
                {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah-dokumen">
                    <i class="mdi mdi-account-edit me-1"></i>Tambah Dokumen
                </button> --}}
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

<div id="tambah-dokumen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-dokumenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambah-dokumenLabel">Tambah Dokumen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahDokumen" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Nama Dokumen</label>
                                    <div class="input-group" id="nama_dokumen">
                                        <input id="nama_dokumen" type="text" class="form-control" name="nama_dokumen" data-provide="nama_dokumen">
                                    </div>
                                </div>
                            </div>       
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  <script>

  </script>

@endsection