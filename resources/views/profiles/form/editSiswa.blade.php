@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Profile Siswa</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateProfileSiswa/{{ Crypt::encrypt($siswa->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="name" 
                  name="nama_siswa" value="{{ $siswa->nama_siswa }}" required autofocus>
                  @error('nama_siswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="number" class="form-control @error('nis') is-invalid @enderror" id="nis" 
                    name="nis" value="{{ $siswa->nis }}" required autofocus>
                    @error('nis')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="example-select" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="example-select">
                      @if(old('agama') == $siswa->agama)
                        <option value="{{ $siswa->agama }}" selected>{{ $siswa->agama }}</option> 
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katholik">Katholik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option> 
                      @else 
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katholik">Katholik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                      @endif
                    </select>
                </div>
                <div class="mb-3">
                  <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" 
                  name="tgl_lahir" value="{{ $siswa->tgl_lahir }}" required autofocus> 
                  @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
            <div class="mb-3">
                <label for="example-select" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jk" id="example-select">
                  @if(old('jk') == $siswa->jk)
                    <option value="{{ $siswa->jk }}" selected>{{ $siswa->jk }}</option>
                     <option value="Laki - laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>  
                  @else 
                    <option value="Laki - laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>
                  @endif
                </select>
            </div>
            <div class="mb-3">
              <label for="no_telp" class="form-label">No. Telp</label>
              <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
              name="no_telp" value="{{ $siswa->no_telp }}" required autofocus>
              @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>    
              @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="name" 
                name="alamat" value="{{ $siswa->alamat }}" required autofocus>
                @error('alamat')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                @enderror
              </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Foto Profile</label>
                  <input type="hidden" name="oldImage" value="{{ $siswa->foto_profile }}">
                  @if ($siswa->foto_profile)
                    <img src="{{ asset('storage/' . $siswa->foto_profile) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
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