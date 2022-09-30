@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Data Siswa</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateDataSiswa/{{ Crypt::encrypt($siswa->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control @error('nama_siswa')  is-invalid @enderror" id="nama_siswa" name="nama_siswa" 
                     value="{{ $siswa->nama_siswa }}"  required autofocus>
                    @error('nama_siswa')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="example-select" class="form-label">Pilih Angkatan</label>
                    <select class="form-select" name="angkatan_id" id="example-select">
                    @foreach($angkatan as $a)
                        @if(old('angkatan_id', $siswa->angkatan_id) == $a->id)
                            <option value="{{ $a->id }}" selected>{{ $a->angkatan  }}</option>  
                        @else   
                            <option value="{{ $a->id }}">{{ $a->angkatan }}</option>
                        @endif
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" value="{{ $siswa->tahun_lulus }}" name="tahun_lulus" 
                     required autofocus>
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
    
  </script>

@endsection