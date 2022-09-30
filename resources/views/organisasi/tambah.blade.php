@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Tambah Riwayat Organisasi</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/simpanOrganisasi" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                    <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror" id="nama_organisasi" 
                    name="nama_organisasi" value="{{ old('nama_organisasi') }}"  required autofocus>
                    @error('nama_organisasi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="example-select" class="form-label">Bidang Organisasi</label>
                    <select class="form-select" name="bidang_organisasi" id="bidang_organisasi" value="{{ old('bidang_organisasi') }}">
                      <option selected disabled>Bidang Organisasi</option>
                        <option value="Pendidikan">Pendidikan</option>
                        <option value="Keagamaan">Keagamaan</option>
                        <option value="Himpunan">Himpunan</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Politik">Politik</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" 
                    name="jabatan" value="{{ old('jabatan') }}">
                    @error('jabatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Periode</label>
                  <input type="text" class="form-control @error('periode') is-invalid @enderror" id="name" 
                  name="periode" value="{{ old('periode') }}" required autofocus>
                  @error('periode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Bukti Mengikuti Organisasi</label>
                    <input type="hidden" name="oldImage">

                      <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('bukti_organisasi') is-invalid @enderror" type="file" id="bukti_organisasi" name="bukti_organisasi" 
                    onchange="previewImage()">
                    @error('bukti_organisasi')
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