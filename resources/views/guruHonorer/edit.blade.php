@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Guru Honorer</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateGuruHonorer/{{ Crypt::encrypt($honorer->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalipd @enderror" id="nama_lengkap" 
                     value="{{ $honorer->pegawai->nama_lengkap }}" readonly required autofocus>
                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <?php 
                    $diff = date_diff( $honorer->pegawai->created_at, $tanggal );
                ?>
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Masa Kerja</label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalipd @enderror" id="nama_lengkap" 
                     value="{{ $diff->y }} Tahun {{ $diff->m }} Bulan" readonly required autofocus>
                    
                </div>

                <input type="hidden" name="pegawai_id" value="{{ $honorer->pegawai_id }}">

                <div class="mb-3">
                  <label for="name" class="form-label">Gaji Pokok</label>
                  <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="name" 
                  name="gaji_pokok" value="{{ $honorer->gaji_pokok }}" required autofocus>
                  @error('gaji_pokok')
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