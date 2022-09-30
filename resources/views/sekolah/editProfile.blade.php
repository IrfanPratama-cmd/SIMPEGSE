@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Profile Sekolah</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateProfileSekolah/{{ Crypt::encrypt($sekolah->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Sekolah</label>
                  <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="name" 
                  name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" required autofocus>
                  @error('nama_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
                    name="no_telp" value="{{ $sekolah->no_telp }}" required autofocus>
                    @error('no_telp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" 
                  name="alamat" value="{{ $sekolah->alamat }}" required autofocus>
                  @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Foto Sekolah</label>
                  <input type="hidden" name="oldImage" value="{{ $sekolah->foto_sekolah }}">
                  @if ($sekolah->foto_sekolah)
                    <img src="{{ asset('storage/' . $sekolah->foto_sekolah) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input class="form-control @error('foto_sekolah') is-invalid @enderror" type="file" id="foto_sekolah" name="foto_sekolah" 
                  onchange="previewImage()">
                  @error('foto_sekolah')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                  @enderror
              </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
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