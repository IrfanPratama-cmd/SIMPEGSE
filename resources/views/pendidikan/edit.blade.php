@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Pendidikan</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updatePendidikan/{{ Crypt::encrypt($pendidikan->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="example-select" class="form-label">Jenjang Pendidikan</label>
                    <select class="form-select" name="jenjang_pendidikan" id="example-select">
                      @if(old('jenjang_pendidikan') == $pendidikan->jenjang_pendidikan)
                        <option value="{{ $pendidikan->jenjang_pendidikan }}" selected>{{ $pendidikan->jenjang_pendidikan }}</option>  
                      @else 
                      <option value="TK">TK</option>
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMK">SMK</option>
                      <option value="SMA">SMA</option>
                      <option value="D-3">D-3</option>
                      <option value="S-1">S-1</option>
                      <option value="S-2">S-2</option>
                      <option value="S-3">S-3</option>
                      @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_instansi" class="form-label">Nama Anak</label>
                    <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="nama_instansi" 
                    name="nama_instansi" value="{{ $pendidikan->nama_instansi }}" required autofocus>
                    @error('nama_instansi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi" 
                    name="prodi" value="{{ $pendidikan->prodi }}" required autofocus>
                    @error('prodi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Tahun Masuk</label>
                  <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" id="name" 
                  name="tahun_masuk" value="{{ $pendidikan->tahun_masuk }}" required autofocus>
                  @error('tahun_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Tahun Lulus</label>
                  <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="name" 
                  name="tahun_lulus" value="{{ $pendidikan->tahun_lulus }}" required autofocus>
                  @error('tahun_lulus')
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