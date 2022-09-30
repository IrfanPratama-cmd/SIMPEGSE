@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Pasangan</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updatePasangan/{{ Crypt::encrypt($pasangan->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_pasangan" class="form-label">Nama Pasangan</label>
                    <input type="text" class="form-control @error('nama_pasangan') is-invalid @enderror" id="nama_pasangan" 
                    name="nama_pasangan" value="{{ $pasangan->nama_pasangan }}" required autofocus>
                    @error('nama_pasangan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">NIK</label>
                  <input type="number" class="form-control @error('nik') is-invalid @enderror" id="name" 
                  name="nik" value="{{ $pasangan->nik }}" required autofocus>
                  @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="example-select" class="form-label">Status Pasangan</label>
                  <select class="form-select" name="status_pasangan" id="example-select">
                    @if(old('status_pasangan') == $pasangan->status_pasangan)
                      <option value="{{ $pasangan->status_pasangan }}" selected>{{ $pasangan->status_pasangan }}</option>  
                    @else 
                      <option value="Suami">Suami</option>
                      <option value="Istri">Istri</option>
                    @endif
                  </select>
              </div>

                <div class="mb-3">
                    <label for="example-select" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="example-select">
                      @if(old('agama') == $pasangan->agama)
                        <option value="{{ $pasangan->agama }}" selected>{{ $pasangan->agama }}</option>  
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
                  <label for="tgl_lahir" class="form-label">Tempat, Tanggal Lahir</label>
                  <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" 
                  name="tgl_lahir" value="{{ $pasangan->tgl_lahir }}" required autofocus>
                  @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
              
              <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
                name="no_telp" value="{{ $pasangan->no_telp }}" required autofocus>
                @error('no_telp')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                @enderror
            </div>

            <div class="mb-3">
                <label for="example-select" class="form-label">Status</label>
                <select class="form-select" name="status" id="example-select">
                  @if(old('status') == $pasangan->status)
                    <option value="{{ $pasangan->status }}" selected>{{ $pasangan->status }}</option>  
                  @else 
                    <option value="Menikah">Menikah</option>
                    <option value="Cerai">Cerai</option>
                    <option value="Meninggal">Meninggal</option>
                  @endif
                </select>
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