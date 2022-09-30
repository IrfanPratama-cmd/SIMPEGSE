@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Pengajuan Cuti</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/simpanCuti" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                  <select class="form-select" name="jenis_cuti" id="example-select">
                    <option selected disabled>Pilih Jenis Cuti</option>
                      <option value="Cuti Tahunan">Cuti Tahunan</option>
                      <option value="Cuti Sakit">Cuti Sakit</option>
                      <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                      <option value="Cuti Besar">Cuti Besar</option>
                      <option value="Lain -lain">Lain -lain</option>
                  </select>
              </div>
                <div class="mb-3">
                    <label for="brp_hari" class="form-label">Lama Cuti Berapa Hari</label>
                    <input type="number" class="form-control @error('brp_hari') is-invalid @enderror" id="brp_hari" 
                    name="brp_hari"  required autofocus>
                    @error('brp_hari')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="alasan" class="form-label">Alasan</label>
                  <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="name" 
                  name="alasan"  required autofocus>
                  @error('alasan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                  <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="name" 
                  name="tgl_mulai"  required autofocus>
                  @error('tgl_mulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                
                <div class="mb-3">
                    <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="name" 
                    name="tgl_selesai"  required autofocus>
                    @error('tgl_selesai')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Bukti Pendukung</label>
                    <input type="file" id="example-fileinput" class="form-control" name="bukti_cuti">
                </div> 
                
                <button type="submit" class="btn btn-primary">Mengajukan Cuti</button>
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


@endsection