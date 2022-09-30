@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Mapel Guru</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateMapelGuru/{{ Crypt::encrypt($mapel->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="mb-3">
                    <label for="example-select" class="form-label">Pilih Pegawai</label>
                    <select class="form-select" name="pegawai_id" id="example-select">
                    @foreach($pegawai as $p)
                        @if(old('pegawai_id', $mapel->pegawai_id) == $p->id)
                            <option value="{{ $p->id}}" selected>{{ $p->nama_lengkap }}</option>  
                        @else 
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                        @endif
                    @endforeach
                    </select>
                </div>


                    <div class="mb-3">
                        <label for="example-select" class="form-label">Pilih Mapel</label>
                        <select class="form-select" name="mapel_id" id="example-select">
                        @foreach($TMMapel as $m)
                            @if(old('mapel_id', $mapel->mapel_id) == $m->id)
                                <option value="{{ $m->id }}" selected>{{ $m->nama_mapel  }}</option>  
                            @else   
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
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