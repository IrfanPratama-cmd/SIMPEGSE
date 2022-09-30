@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Pegawai</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updatePegawaiAdmin/{{ Crypt::encrypt($pegawai->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" 
                    name="nama_lengkap" value="{{ $pegawai->nama_lengkap }}" required autofocus>
                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="example-select" class="form-label">Golongan Guru</label>
                    <select class="form-select" name="golongan_guru" id="example-select" value="{{ $pegawai->golongan_guru }}">
                      @if(old('golongan_guru', $pegawai->golongan_guru) == $pegawai->golongan_guru)
                        <option value="Guru PNS">Guru PNS</option>
                        <option value="Guru PPPK">Guru PPPK</option>
                        <option value="Guru Honorer">Guru Honorer</option>
                        <option value="Bukan Guru">Bukan Guru</option> 
                      @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tgl_masuk   " class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control @error('created_at') is-invalid @enderror" id="created_at" 
                    name="created_at" value="{{ $pegawai->created_at->format('Y-m-d') }}"  required autofocus>
                    <span id="created_at" class="alert-message"></span>
                    @error('created_at')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror          
                </div>
                <div class="mb-3">
                  <label for="example-select" class="form-label">Status</label>
                  <select class="form-select" name="status" id="example-select" value="{{ $pegawai->status }}">
                    @if(old('status', $pegawai->status) == $pegawai->status)
                      {{-- <option value="{{ $pegawai->status }}" selected>{{ $pegawai->status }}</option>  --}}
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
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
    
  </script>

@endsection