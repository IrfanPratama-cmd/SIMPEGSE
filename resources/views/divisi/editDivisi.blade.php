@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Edit Divisi</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/updateDivisi/{{ Crypt::encrypt($divisi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_divisi" class="form-label">Nama Divisi</label>
                    <input type="text" class="form-control @error('nama_divisi') is-invalid @enderror" id="nama_divisi" 
                    name="nama_divisi" value="{{ $divisi->nama_divisi }}" required autofocus>
                    @error('nama_divisi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
              

                <div class="mb-3">
                    <label for="example-select" class="form-label">Pilih Admin</label>
                    <select class="form-select" name="user_id" id="example-select">
                      {{-- <option selected disabled>Pilih Admin</option> --}}
                      @foreach ($admin as $a)
                        @if(old('user_id') == $a->id)
                            <option value="{{ $a->id}}" selected>{{ $a->name}}</option>
                        @else
                            <option value="{{ $a->id}}">{{ $a->name}}</option>
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