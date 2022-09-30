@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Anak</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateAnak/{{ Crypt::encrypt($anak->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_anak" class="form-label">Nama Anak</label>
                    <input type="text" class="form-control @error('nama_anak') is-invalid @enderror" id="nama_anak" 
                    name="nama_anak" value="{{ $anak->nama_anak }}" required autofocus>
                    @error('nama_anak')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">NIK</label>
                  <input type="number" class="form-control @error('nik') is-invalid @enderror" id="name" 
                  name="nik" value="{{ $anak->nik }}" required autofocus>
                  @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Anak Ke</label>
                  <input type="number" class="form-control @error('anak_nmr') is-invalid @enderror" id="name" 
                  name="anak_nmr" value="{{ $anak->anak_nmr }}" required autofocus>
                  @error('anak_nmr')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="example-select" class="form-label">Jenis Kelamin</label>
                  <select class="form-select" name="jk" id="example-select">
                    @if(old('jk') == $anak->jk)
                      <option value="{{ $anak->jk }}" selected>{{ $anak->jk }}</option>  
                    @else 
                      <option value="Laki - laki">Laki - laki</option>
                      <option value="Perempuan">Perempuan</option>
                    @endif
                  </select>
              </div>

                <div class="mb-3">
                    <label for="example-select" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="example-select">
                      @if(old('agama') == $anak->agama)
                        <option value="{{ $anak->agama }}" selected>{{ $anak->agama }}</option>  
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
                  name="tgl_lahir" value="{{ $anak->tgl_lahir }}" required autofocus>
                  @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
              
              <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" 
                name="no_telp" value="{{ $anak->no_telp }}" required autofocus>
                @error('no_telp')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                @enderror
            </div>

            <div class="mb-3">
                <label for="example-select" class="form-label">Status</label>
                <select class="form-select" name="status" id="example-select">
                  @if(old('status') == $anak->status)
                    <option value="{{ $anak->status }}" selected>{{ $pasangan->status }}</option>  
                  @else 
                    <option value="Hidup">Hidup</option>
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