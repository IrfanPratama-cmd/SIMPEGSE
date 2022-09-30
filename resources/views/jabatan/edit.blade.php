@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Jabatan</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateJabatan/{{ Crypt::encrypt($jabatan->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" 
                    name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}" required autofocus>
                    @error('nama_jabatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                {{-- <div class="mb-3">
                  <label for="name" class="form-label">Gaji Pokok</label>
                  <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="name" 
                  name="gaji_pokok" value="{{ $jabatan->gaji_pokok }}" required autofocus>
                  @error('gaji_pokok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div> --}}

                  
                {{-- <div class="mb-3">
                  <label for="name" class="form-label">Tunjangan Pasangan</label>
                  <input type="number" class="form-control @error('tunjangan_pasangan') is-invalid @enderror" id="name" 
                  name="tunjangan_pasangan" value="{{ $jabatan->tunjangan_pasangan }}" required autofocus>
                  @error('tunjangan_pasangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Tunjangan Anak</label>
                  <input type="number" class="form-control @error('tunjangan_anak') is-invalid @enderror" id="name" 
                  name="tunjangan_anak" value="{{ $jabatan->tunjangan_anak }}" required autofocus>
                  @error('tunjangan_anak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                  <div class="mb-3">
                    <label for="name" class="form-label">Tunjangan Transport</label>
                    <input type="number" class="form-control @error('tunjangan_transport') is-invalid @enderror" id="name" 
                    name="tunjangan_transport" value="{{ $jabatan->tunjangan_transport }}" required autofocus>
                    @error('tunjangan_transport')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                  </div> --}}

               
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
    
  </script>

@endsection