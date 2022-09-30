@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Mapel</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateMapel/{{ Crypt::encrypt($mapel->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Nama Mapel</label>
                    <input type="text" class="form-control @error('nama_mapel') is-invalid @enderror" id="nama_mapel" 
                    name="nama_mapel" value="{{ $mapel->nama_mapel }}" required autofocus>
                    @error('nama_mapel')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Gaji</label>
                  <input type="number" class="form-control @error('gaji') is-invalid @enderror" id="name" 
                  name="gaji" value="{{ $mapel->gaji }}" required autofocus>
                  @error('gaji')
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