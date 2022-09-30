@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Riwayat Organisasi</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateOrganisasi/{{ Crypt::encrypt($organisasi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-3">
                    <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                    <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror" id="nama_organisasi" 
                    name="nama_organisasi" value="{{ $organisasi->nama_organisasi }}" required autofocus>
                    @error('nama_organisasi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="example-select" class="form-label">Bidang Organisasi</label>
                    <select class="form-select" name="bidang_organisasi" id="example-select">
                      @if(old('bidang_organisasi') == $organisasi->bidang_organisasi)
                        <option value="{{ $organisasi->bidang_organisasi }}" selected>{{ $organisasi->bidang_organisasi }}</option>  
                      @else 
                      <option value="Pendidikan">Pendidikan</option>
                      <option value="Keagamaan">Keagamaan</option>
                      <option value="Himpunan">Himpunan</option>
                      <option value="Sosial">Sosial</option>
                      <option value="Politik">Politik</option>
                      @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" 
                    name="jabatan" value="{{ $organisasi->jabatan }}" required autofocus>
                    @error('jabatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Periode</label>
                  <input type="text" class="form-control @error('periode') is-invalid @enderror" id="name" 
                  name="periode" value="{{ $organisasi->periode }}" required autofocus>
                  @error('periode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Bukti Organisasi</label>
                    <input type="hidden" name="oldImage" value="{{ $organisasi->bukti_organisasi }}">
                    @if ($organisasi->bukti_organisasi)
                      <img src="{{ url('bukti-organisasi/' . $organisasi->bukti_organisasi) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block ">
                    @else
                      <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input class="form-control @error('bukti_organisasi') is-invalid @enderror" type="file" id="bukti_organisasi" name="bukti_organisasi" 
                    onchange="previewImage()">
                    @error('bukti_organisasi')
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