@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
          @if($dokumen->kategori == "Pegawai")
            <h1 class="my-1">Edit Dokumen Pegawai</h1>
          @elseif($dokumen->kategori == "Siswa")
            <h1 class="my-1">Edit Dokumen Siswa</h1>
          @endif
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateDokumen/{{ Crypt::encrypt($dokumen->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" id="nama_dokumen" 
                    name="nama_dokumen" value="{{ $dokumen->nama_dokumen }}"  required autofocus>
                    @error('nama_dokumen')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Folder</label>
                  <input type="text" class="form-control @error('folder') is-invalid @enderror" id="name" 
                  name="folder" value="{{ $dokumen->folder }}" required autofocus>
                  @error('folder')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                  name="tanggal" value="{{ $dokumen->tanggal }}" required autofocus>
                  @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>

              <input type="hidden" name="kategori" value="{{ $dokumen->kategori }}">

              {{-- <div class="mb-3">
                <label for="example-select" class="form-label">Kategori Dokumen</label>
                <select class="form-select" name="kategori" id="example-select">
                  <option selected disabled>{{ $dokumen->kategori }}</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Siswa">Siswa</option>
                </select>
              </div> --}}

              @if($dokumen->kategori == "Siswa")
                
               <div class="mb-3">
                <label for="example-select" class="form-label">Angkatan</label>
                <select class="form-select" name="angkatan_id" id="example-select" value="{{ $dokumen->angkatan->angkatan }}">
                  {{-- <option selected disabled>{{ $dokumen->angkatan->angkatan }}</option> --}}
                  @foreach($angkatan as $a)
                    <option value="{{ $a->id }}">{{ $a->angkatan }}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                @error('keterangan')
                <p class="text-danger">{{ $message }}</p>    
                @enderror
                <input id="keterangan" type="hidden" name="keterangan" value="{{$dokumen->keterangan }}">
                <trix-editor input="keterangan"></trix-editor>
            </div>
                <button type="submit" class="btn btn-primary">Edit Dokumen</button>
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