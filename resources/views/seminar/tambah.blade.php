@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Tambah Riwayat Seminar</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/simpanSeminar" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_seminar" class="form-label">Nama Seminar</label>
                    <input type="text" class="form-control @error('nama_seminar') is-invalid @enderror" id="nama_seminar" 
                    name="nama_seminar" value="{{ old('nama_seminar') }}"  required autofocus>
                    @error('nama_seminar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="penyelenggara" class="form-label">Penyelenggara</label>
                  <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" id="penyelenggara" 
                  name="penyelenggara" value="{{ old('penyelenggara') }}"  required autofocus>
                  @error('penyelenggara')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                    <label for="tempat_seminar" class="form-label">Tempat Seminar</label>
                    <input type="text" class="form-control @error('tempat_seminar') is-invalid @enderror" id="tempat_seminar" 
                    name="tempat_seminar" value="{{ old('tempat_seminar') }}">
                    @error('tempat_seminar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                  name="tanggal" value="{{ old('tanggal') }}" required autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Bukti Mengikuti Seminar</label>
                    <input type="hidden" name="oldImage">

                      <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('bukti_seminar') is-invalid @enderror" type="file" id="bukti_seminar" name="bukti_seminar" 
                    onchange="previewImage()">
                    @error('bukti_seminar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                    @enderror
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


      <script src="/hyper/assets/js/jquery/jquery.min.js"></script>
      <script src="/hyper/assets/js/toastr/toastr.min.js"></script>
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