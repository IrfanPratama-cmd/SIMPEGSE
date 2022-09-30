@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Riwayat Seminar</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateSeminar/{{ Crypt::encrypt($seminar->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-3">
                    <label for="nama_seminar" class="form-label">Nama Seminar</label>
                    <input type="text" class="form-control @error('nama_seminar') is-invalid @enderror" id="nama_seminar" 
                    name="nama_seminar" value="{{ $seminar->nama_seminar }}" required autofocus>
                    @error('nama_seminar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="penyelenggara" class="form-label">Penyelenggara</label>
                  <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" id="penyelenggara" 
                  name="penyelenggara" value="{{ $seminar->penyelenggara }}" required autofocus>
                  @error('penyelenggara')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>

                <div class="mb-3">
                    <label for="tempat_seminar" class="form-label">Tempat Seminar</label>
                    <input type="text" class="form-control @error('tempat_seminar') is-invalid @enderror" id="tempat_seminar" 
                    name="tempat_seminar" value="{{ $seminar->tempat_seminar }}" required autofocus>
                    @error('tempat_seminar')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                  name="tanggal" value="{{ $seminar->tanggal }}" required autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Bukti Seminar</label>
                    <input type="hidden" name="oldImage" value="{{ $seminar->bukti_seminar }}">
                    @if ($seminar->bukti_seminar)
                      <img src="{{ url('bukti-seminar/' . $seminar->bukti_seminar) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                    @else
                      <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control @error('bukti_seminar') is-invalid @enderror" type="file" id="bukti_seminar" name="bukti_seminar" 
                    onchange="previewImage()">
                    @error('bukti_seminar')
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