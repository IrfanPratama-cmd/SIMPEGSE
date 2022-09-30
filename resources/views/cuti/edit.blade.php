@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Pengajuan Cuti</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateCuti/{{ Crypt::encrypt($cuti->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                  <select class="form-select" name="jenis_cuti" id="example-select">
                    @if(old('jenis_cuti') == $cuti->jenis_cuti)
                      <option value="{{ $cuti->jenis_cuti }}" selected>{{ $cuti->jenis_cuti }}</option>  
                    @else 
                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                    <option value="Cuti Sakit">Cuti Sakit</option>
                    <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                    <option value="Cuti Besar">Cuti Besar</option>
                    <option value="Lain -lain">Lain -lain</option>
                    @endif
                  </select>
              </div>
                <div class="mb-3">
                    <label for="brp_hari" class="form-label">Lama Cuti Berapa Hari</label>
                    <input type="number" class="form-control @error('brp_hari') is-invalid @enderror" id="brp_hari" 
                    name="brp_hari" value="{{ $cuti->brp_hari }}"  required autofocus>
                    @error('brp_hari')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="alasan" class="form-label">Alasan</label>
                  <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="name" 
                  name="alasan" value="{{ $cuti->alasan }}"  required autofocus>
                  @error('alasan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                  <input type="date" class="form-control @error('tgl_awal') is-invalid @enderror" id="name" 
                  name="tgl_awal" value="{{ $cuti->tgl_awal }}"  required autofocus>
                  @error('tgl_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                
                <div class="mb-3">
                    <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" id="name" 
                    name="tgl_akhir" value="{{ $cuti->tgl_akhir }}"  required autofocus>
                    @error('tgl_akhir')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                  </div>
                
                <button type="submit" class="btn btn-primary">Edit Cuti</button>
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