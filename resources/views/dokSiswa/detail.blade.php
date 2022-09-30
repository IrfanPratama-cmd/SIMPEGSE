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
                    <li class="breadcrumb-item">Data Dokumen</li>
                    <li class="breadcrumb-item active">{{ $dokumen->nama_dokumen }}</li>
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

                <h2 class="text-info">{{ $dokumen->nama_dokumen }}</h2>

                <article>
                    {!! $dokumen->keterangan !!} 
                </article>

                <br> <br>
                
                @if($cekDokumen >= 1)
                    <h2>Anda Sudah Upload!</h2>
                    {{-- <a href="/downloadFile/{{ $dokumen->folder }}/{{ $nama_file }}">Lihat File</a> --}}

                    <table class="table">
                        <tbody>
                          <tr>
                            <td width="30%"><h4> Waktu Upload </h4></td>
                            <td width="5%"><h4>:</h4></td>
                            <td><h4> {{ $tanggal_upload}}, {{ $waktu_upload }} </h4></td>
                          </tr>
                          <tr>
                            <td width="30%"><h4> Nama File </h4></td>
                            <td width="5%"><h4>:</h4></td>
                            <td><h4><a href="/downloadFileSiswa/{{ $dokumen->folder }}/{{ $nama_file }}">{{ $nama_file }}</a> </h4></td>
                          </tr>
                        </tbody>
        
                      </table>

                      <a href="/editFileSiswa/{{ Crypt::encrypt($id) }}" class="btn btn-info">Edit File</a>
                @else
                <!-- File Upload -->
                <form action="/uploadDokumenSiswa" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                    data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="dokumen_id" value="{{ $dokumen->id }}">

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Default file input</label>
                        <input type="file" id="example-fileinput" class="form-control" name="nama_file">
                    </div>

                    <button type="submit" class="btn btn-info md-3">Upload</button>
                    @endif
            </div> <!-- end card-body-->
            
        </form>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

  <script>
      
  </script>

@endsection