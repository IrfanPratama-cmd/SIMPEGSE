@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
          <h1 class="my-1">Tambah Dokumen Pegawai</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/simpanDokumen" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" id="nama_dokumen" 
                    name="nama_dokumen"  required autofocus>
                    @error('nama_dokumen')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Folder</label>
                  <input type="text" class="form-control @error('folder') is-invalid @enderror" id="name" 
                  name="folder"  required autofocus>
                  @error('folder')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                  name="tanggal" required autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>

              {{-- <div class="mb-3">
                <label for="example-select" class="form-label">Kategori Dokumen</label>
                <select class="form-select" name="kategori" id="example-select">
                  <option selected disabled>Kategori Dokumen</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Siswa">Siswa</option>
                </select>
              </div> --}}
              
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                @error('keterangan')
                <p class="text-danger">{{ $message }}</p>    
                @enderror
                <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan') }}">
                <trix-editor input="keterangan"></trix-editor>
            </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          {{-- @endforeach   --}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


  <script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
  </script>

@endsection