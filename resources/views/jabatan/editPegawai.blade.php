@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Jabatan Pegawai</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateJabatanPegawai/{{ Crypt::encrypt($jabatan->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="mb-3">
                    <label for="example-select" class="form-label">Pilih Pegawai</label>
                    <select class="form-select" name="pegawai_id" id="example-select">
                    @foreach($pegawai as $p)
                        @if(old('pegawai_id', $jabatan->pegawai_id) == $p->id)
                            <option value="{{ $p->id}}" selected>{{ $p->nama_lengkap }}</option>  
                        @else 
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @endif
                    @endforeach
                    </select>
                </div>


                    <div class="mb-3">
                        <label for="example-select" class="form-label">Pilih Jabatan</label>
                        <select class="form-select" name="jabatan_id" id="example-select">
                        @foreach($TMjabatan as $j)
                            @if(old('jabatan_id', $jabatan->jabatan_id) == $j->id)
                                <option value="{{ $j->id }}" selected>{{ $j->nama_jabatan  }}</option>  
                            @else   
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
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