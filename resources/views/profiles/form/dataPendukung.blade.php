@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Data Pendukung</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateDataPendukung/{{ Crypt::encrypt($pegawai->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">NIK</label>
                  <input type="number" class="form-control @error('nik') is-invalid @enderror" id="name" 
                  name="nik" value="{{ $pegawai->nik }}" required autofocus>
                  @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="no_kk" class="form-label">Nomor KK</label>
                    <input type="number" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" 
                    name="no_kk" value="{{ $pegawai->no_kk }}" required autofocus>
                    @error('no_kk')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="example-select" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="example-select">
                      @if(old('agama') == $pegawai->agama)
                        <option value="{{ $pegawai->agama }}" selected>{{ $pegawai->agama }}</option> 
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
                  name="tgl_lahir" value="{{ $pegawai->tgl_lahir }}" required autofocus> 
                  @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                  <label for="no_npwp" class="form-label">No. NPWP</label>
                  <input type="number" class="form-control @error('no_npwp') is-invalid @enderror" id="no_npwp" 
                  name="no_npwp" value="{{ $pegawai->no_npwp }}" required autofocus>
                  @error('no_npwp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
              <div class="mb-3">
                <label for="no_bpjs" class="form-label">No. BPJS</label>
                <input type="number" class="form-control @error('no_bpjs') is-invalid @enderror" id="no_bpjs" 
                name="no_bpjs" value="{{ $pegawai->no_bpjs }}" required autofocus>
                @error('no_bpjs')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                @enderror
            </div>
            <div class="mb-3">
              <label for="no_rekening" class="form-label">No. Rekening</label>
              <input type="number" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" 
              name="no_rekening" value="{{ $pegawai->no_rekening }}" required autofocus>
              @error('no_rekening')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>    
              @enderror
          </div>
            <div class="mb-3">
                <label for="example-select" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jk" id="example-select">
                  @if(old('jk') == $pegawai->jk)
                    <option value="{{ $pegawai->jk }}" selected>{{ $pegawai->jk }}</option>
                     <option value="Laki - laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>  
                  @else 
                    <option value="Laki - laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>
                  @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="name" 
                name="alamat" value="{{ $pegawai->alamat }}" required autofocus>
                @error('alamat')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>    
                @enderror
              </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Foto KTP</label>
                  <input type="hidden" name="oldImage" value="{{ $pegawai->foto_ktp }}">
                  @if ($pegawai->foto_ktp)
                    <img src="{{ url('foto-ktp/' . $pegawai->foto_ktp) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                  @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                  @endif
                  <input class="form-control @error('foto_ktp') is-invalid @enderror" type="file" id="foto_ktp" name="foto_ktp" 
                  onchange="previewImage()">
                  @error('foto_ktp')
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