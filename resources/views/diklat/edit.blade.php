@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Riwayat Diklat</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateDiklat/{{ Crypt::encrypt($diklat->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-3">
                    <label for="nama_diklat" class="form-label">Nama Diklat</label>
                    <input type="text" class="form-control @error('nama_diklat') is-invalid @enderror" id="nama_diklat" 
                    name="nama_diklat" value="{{ $diklat->nama_diklat }}" required autofocus>
                    @error('nama_diklat')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="penyelenggara" class="form-label">Penyelenggara</label>
                  <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" id="penyelenggara" 
                  name="penyelenggara" value="{{ $diklat->penyelenggara }}" required autofocus>
                  @error('penyelenggara')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>

                <div class="mb-3">
                    <label for="tempat_diklat" class="form-label">Tempat Diklat</label>
                    <input type="text" class="form-control @error('tempat_diklat') is-invalid @enderror" id="tempat_diklat" 
                    name="tempat_diklat" value="{{ $diklat->tempat_diklat }}" required autofocus>
                    @error('tempat_diklat')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                  name="tanggal" value="{{ $diklat->tanggal }}" required autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Bukti Diklat</label>
                    <input type="hidden" name="oldImage" value="{{ $diklat->bukti_diklat }}">
                    @if ($diklat->bukti_diklat)
                      <img src="{{ url('bukti-diklat/' . $diklat->bukti_diklat) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                    @else
                      <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control @error('bukti_diklat') is-invalid @enderror" type="file" id="bukti_diklat" name="bukti_diklat" 
                    onchange="previewImage()">
                    @error('bukti_diklat')
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