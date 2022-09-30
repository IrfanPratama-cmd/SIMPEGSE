@extends('admin.main')

@section('container')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Tambah Pendidikan</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/simpanPendidikan" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="example-select" class="form-label">Jenjang Pendidikan</label>
                    <select class="form-select" name="jenjang_pendidikan" id="jenjang_pendidikan" value="{{ old('jenjang_pendidikan') }}">
                      <option selected disabled>Pilih Jenjang Pendidikan</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMK">SMK</option>
                        <option value="SMA">SMA</option>
                        <option value="D-3">D-3</option>
                        <option value="S-1">S-1</option>
                        <option value="S-2">S-2</option>
                        <option value="S-3">S-3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_instansi" class="form-label">Nama Institusi / Sekolah</label>
                    <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="nama_instansi" 
                    name="nama_instansi" value="{{ old('nama_instansi') }}"  required autofocus>
                    @error('nama_instansi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div id="addProdi">
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <span class="text-success">(Kosongi jika tidak ada!)</span>
                    <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi" 
                    name="prodi" value="{{ old('prodi') }}">
                    @error('prodi')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Tahun Masuk</label>
                  <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" id="name" 
                  name="tahun_masuk" value="{{ old('tahun_masuk') }}" required autofocus>
                  @error('tahun_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Tahun Lulus</label>
                  <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="name" 
                  name="tahun_lulus" value="{{ old('tahun_lulus') }}"  required autofocus>
                  @error('tahun_lulus')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
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


      <script src="/hyper/assets/js/jquery/jquery.min.js"></script>
      <script src="/hyper/assets/js/toastr/toastr.min.js"></script>
  <script>

    $(document).ready(function(){
      $('#jenjang_pendidikan').change(function(){
          var kel = $('#jenjang_pendidikan option:selected').val();
          if (kel == "D-3") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          } else if(kel == "S-1") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }else if(kel == "S-2") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }else if(kel == "S-3") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }
          } else {
            $('#addProdi').removeClass("mb-3");
            $('#addProdi').html('');
          }
      });
  });
//   function inputAngka(e) {
//     var charCode = (e.which) ? e.which : event.keyCode
//     if (charCode > 31 && (charCode < 48 || charCode > 57)){
//       return false;
//     }
//     return true;
//   }
  </script>

@endsection