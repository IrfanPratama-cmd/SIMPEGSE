@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Master Data PPPK</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateGajiPPPK/{{ Crypt::encrypt($pppk->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Golongan PPPK</label>
                    <input type="text" class="form-control @error('pppk_id') is-invalid @enderror" id="pppk_id" 
                     value="{{ $pppk->pppk->golongan_pppk }}" readonly required autofocus>
                    @error('pppk_id')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <input type="hidden" name="pppk_id" value="{{ $pppk->pppk_id }}">
                <div class="mb-3">
                  <label for="name" class="form-label">Gaji</label>
                  <input type="number" class="form-control @error('gaji_pppk') is-invalid @enderror" id="name" 
                  name="gaji_pppk" value="{{ $pppk->gaji_pppk }}" required autofocus>
                  @error('gaji_pppk')
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