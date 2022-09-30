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
                        <a href="/dokumenPegawai" class="nav-link">
                            List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokumenTabel" class="nav-link active">
                            Tabel
                        </a>
                    </li>
                </ul> <!-- end nav-->
        
                <h2>Data Dokumen</h2>
                <div class="app-search dropdown d-none d-lg-block col-4">
                    <form action="/cariDokTabelPegawai" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="caridok" value="{{ old('caridok') }}"  placeholder="Search Dokumen" id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div><br>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>No. </th>
                                <th>Nama Dokumen</th>
                                <th>Folder</th>
                                <th>Tanggal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                    
                    
                        <tbody>
                            @foreach($dokumen as $d)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama_dokumen }}</td>
                                <td>{{ $d->folder }}</td>
                                <td>{{ $d->tanggal}}</td>
                                <td><a href="/detailDokumen/{{  Crypt::encrypt($d->id) }}" class="btn btn-info">Detail</a></td>
                            </tr>
                            @endforeach              
                        </tbody>
                    </table>
                 <br><br>
                {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah-dokumen">
                    <i class="mdi mdi-account-edit me-1"></i>Tambah Dokumen
                </button> --}}
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

  <script>

  </script>

@endsection