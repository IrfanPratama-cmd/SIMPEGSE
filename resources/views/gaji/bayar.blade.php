@extends('admin.main')

@section('container')

<?php 
  $gaji_pokok =  $gaji->gaji_pokok;
  $tunjangan_pangan = $tunjangan->tunjangan_pangan * $hadir;
  $tunjangan_pasangan = $tunjangan->tunjangan_pasangan * $pasangan;
  $tunjangan_anak = $tunjangan->tunjangan_anak * $anak;
  $total_gaji = $gaji_pokok + $tunjangan_pangan + $tunjangan_pasangan + $tunjangan_anak;
?>

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Bayar Gaji {{ $gaji->pegawai->nama_lengkap }}</h1>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/bayarPegawai/{{ Crypt::encrypt($gaji->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" 
                    name="nama_lengkap" value="{{ $gaji->pegawai->nama_lengkap }}" disabled>
                    @error('nama_lengkap')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>    
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="jabatan" class="form-label">Jabatan</label>
                  <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" 
                  name="jabatan" value="{{ $jabatan->nama_jabatan }}" disabled>
                  @error('jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
              </div>
                <div class="mb-3">
                  <label for="name" class="form-label">No. Rekening</label>
                  <input type="number" class="form-control @error('no_rekening') is-invalid @enderror" id="name" 
                  name="no_rekening" value="{{ $gaji->pegawai->no_rekening }}" disabled>
                  @error('no_rekening')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="name" class="form-label">Total Gaji</label>
                  <input type="text" class="form-control @error('total_gaji') is-invalid @enderror" id="name" 
                  value="Rp. {{  number_format($total_gaji) }}" readonly>
                  @error('total_gaji')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>    
                  @enderror
                </div>

                <input type="hidden" name="tunjangan_pasangan" value="{{ $tunjangan_pasangan }}">
                <input type="hidden" name="tunjangan_anak" value="{{ $tunjangan_anak }}">
                <input type="hidden" name="tunjangan_pangan" value="{{ $tunjangan_pangan }}">
                <input type="hidden" name="total_gaji" value="{{ $total_gaji }}">

                <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Bukti Pembayaran</label>
                    <input type="file" id="example-fileinput" class="form-control" name="bukti_pembayaran">
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