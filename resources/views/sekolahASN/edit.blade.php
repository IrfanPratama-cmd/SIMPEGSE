@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Master Data PNS</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateGajiASN/{{ Crypt::encrypt($asn->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Golongan PNS</label>
                    <input type="text" class="form-control @error('asn_id') is-invalid @enderror" id="asn_id" 
                     value="{{ $asn->asn->golongan_asn }}" readonly required autofocus>
                    @error('asn_id')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <input type="hidden" name="asn_id" value="{{ $asn->asn_id }}">
                <div class="mb-3">
                  <label for="name" class="form-label">Gaji</label>
                  <input type="number" class="form-control @error('gaji_asn') is-invalid @enderror" id="name" 
                  name="gaji_asn" value="{{ $asn->gaji_asn }}" required autofocus>
                  @error('gaji_asn')
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