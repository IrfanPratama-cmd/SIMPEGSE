@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Instansi</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              {{-- @foreach ($instansi as $i) --}}
              <form action="/updateAdmin/{{ $instansi->id }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                {{-- <div class="mb-3">
                  <label for="name" class="form-label">Username</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                  name="name" value="{{ $instansi->user->name }}" required autofocus>
                  @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Instansi</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                    name="name" value="{{ $instansi->name }}" required autofocus>
                    @error('name')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
                    name="no_telp" value="{{ $instansi->no_telp }}" required autofocus>
                    @error('no_telp')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" 
                  name="alamat" value="{{ $instansi->alamat }}" required autofocus>
                  @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar Instansi</label>
                  <input type="hidden" name="oldImage" value="{{ $instansi->foto_instansi }}">
                  @if ($instansi->foto_instansi)
                    <img src="{{ asset('storage/' . $instansi->foto_instansi) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input class="form-control @error('foto_instansi') is-invalid @enderror" type="file" id="foto_instansi" name="foto_instansi" 
                  onchange="previewImage()">
                  @error('foto_instansi')
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