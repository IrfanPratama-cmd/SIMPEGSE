@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Guru PPPK</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateGuruPPPK/{{ Crypt::encrypt($pppk->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalipd @enderror" id="nama_lengkap" 
                     value="{{ $pppk->pegawai->nama_lengkap }}" readonly required autofocus>
                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <input type="hidden" name="pegawai_id" value="{{ $pppk->pegawai_id }}">
                <div class="mb-3">
                    <label for="example-select" class="form-label">Pilih Golongan PPPK</label>
                    <select class="form-select" name="skh_pppk_id" id="example-select">
                    @foreach($golongan as $a)
                        @if(old('skh_asn_id', $pppk->skh_pppk_id) == $a->id)
                            <option value="{{ $a->id }}" selected>{{ $a->pppk->golongan_pppk  }}</option>  
                        @else   
                            <option value="{{ $a->id }}">{{ $a->pppk->golongan_pppk }}</option>
                        @endif
                    @endforeach
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