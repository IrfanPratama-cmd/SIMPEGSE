@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Setting</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateSetting/{{ Crypt::encrypt($setting->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Jumlah Cuti</label>
                  <input type="number" class="form-control @error('cuti') is-invalid @enderror" id="name" 
                  name="cuti" value="{{ $setting->cuti }}" required autofocus>
                  @error('cuti')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Jam Masuk</label>
                  <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" id="name" 
                  name="jam_masuk" value="{{ $setting->jam_masuk }}" required autofocus>
                  @error('jam_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Jam Absen</label>
                  <input type="time" class="form-control @error('jam_absen') is-invalid @enderror" id="name" 
                  name="jam_absen" value="{{ $setting->jam_absen }}" required autofocus>
                  @error('jam_absen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Jam Pulang</label>
                  <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" id="name" 
                  name="jam_pulang" value="{{ $setting->jam_pulang }}" required autofocus>
                  @error('jam_pulang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="kepala_sekolah" class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror" id="kepala_sekolah" 
                    name="kepala_sekolah" value="{{ $setting->kepala_sekolah }}" required autofocus>
                    @error('kepala_sekolah')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">TTD Kepala Sekolah</label>
                  <input type="hidden" name="oldImage" value="{{ $setting->ttd_pimpinan }}">
                  @if ($setting->ttd_pimpinan)
                    <img src="{{ asset('storage/' . $setting->ttd_pimpinan) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input class="form-control @error('ttd_pimpinan') is-invalid @enderror" type="file" id="ttd_pimpinan" name="ttd_pimpinan" 
                  onchange="previewImage()">
                  @error('ttd_pimpinan')
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