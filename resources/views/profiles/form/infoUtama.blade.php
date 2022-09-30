@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Informasi Utama</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateInfoUtama/{{ Crypt::encrypt($pegawai->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="name" 
                  name="nama_lengkap" value="{{ $pegawai->nama_lengkap }}" required autofocus>
                  @error('nama_lengkap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
                    name="no_telp" value="{{ $pegawai->no_telp }}" required autofocus>
                    @error('no_telp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="nip" class="form-label">NIP</label>
                  <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip" 
                  name="nip" value="{{ $pegawai->nip }}" required autofocus>
                  @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Foto Profil</label>
                  <input type="hidden" name="oldImage" value="{{ $pegawai->foto_profile }}">
                  @if ($pegawai->foto_profile)
                    <img src="{{ url('foto-profile/' . $pegawai->foto_profile) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input class="form-control @error('foto_profile') is-invalid @enderror" type="file" id="foto_profile" name="foto_profile" 
                  onchange="previewImage()">
                  @error('foto_profile')
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