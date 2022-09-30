@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Tunjangan</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateTunjangan/{{ Crypt::encrypt($tunjangan->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Tunjangan Pasangan</label>
                  <input type="number" class="form-control @error('tunjangan_pasangan') is-invalid @enderror" id="name" 
                  name="tunjangan_pasangan" value="{{ $tunjangan->tunjangan_pasangan }}" required autofocus>
                  @error('tunjangan_pasangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Tunjangan Anak</label>
                  <input type="number" class="form-control @error('tunjangan_anak') is-invalid @enderror" id="name" 
                  name="tunjangan_anak" value="{{ $tunjangan->tunjangan_anak }}" required autofocus>
                  @error('tunjangan_anak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Tunjangan Pangan</label>
                  <input type="number" class="form-control @error('tunjangan_pangan') is-invalid @enderror" id="name" 
                  name="tunjangan_pangan" value="{{ $tunjangan->tunjangan_pangan }}" required autofocus>
                  @error('tunjangan_pangan')
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
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
  </script>

@endsection