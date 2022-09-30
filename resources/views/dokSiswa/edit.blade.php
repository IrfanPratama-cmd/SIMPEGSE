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

                <h2 class="text-info">{{ $nama_dokumen }}</h2>

                <article>
                    {!! $keterangan !!} 
                </article>

                <br> <br>
                
                <!-- File Upload -->
                <form action="/updateFileSiswa/{{ Crypt::encrypt($dokumen->id) }}" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                    data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <input type="hidden" name="dokumen_id" value="{{ $id }}">

                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Default file input</label>
                        <input type="file" id="example-fileinput" class="form-control" name="nama_file" value="{{ $dokumen->nama_file }}" placeholder="{{ $dokumen->nama_file }}">
                    </div>

                  
                    <button type="submit" class="btn btn-info md-3">Upload</button>
            </div> <!-- end card-body-->
            
        </form>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

  <script>
      
  </script>

@endsection