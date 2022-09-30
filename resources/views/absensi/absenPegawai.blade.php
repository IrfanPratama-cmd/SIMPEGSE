@extends('admin.main')

@section('container')

<script src="{{ asset('js/jam.js') }}"></script>

<style>
  #watch {
      color: rgb(252, 150, 65);
      position: absolute;
      z-index: 1;
      height: 40px;
      width: 700px;
      overflow: show;
      margin: auto;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      font-size: 10vw;
      -webkit-text-stroke: 3px rgb(210, 65, 36);
      text-shadow: 4px 4px 10px rgba(210, 65, 36, 0.4),
          4px 4px 20px rgba(210, 45, 26, 0.4),
          4px 4px 30px rgba(210, 25, 16, 0.4),
          4px 4px 40px rgba(210, 15, 06, 0.4);
  }
</style>

<section class="content" onload="realtimeClock()">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Absen Pegawai</h1>
          <hr>
          <div class="card mt-2">

            @if($localtime >= $absensi->TMabsen->jam_akhir)
              <div class="card-body">
                <h2 class="text-center text-danger">Maaf, Anda terlambat</h2>
                <form action="/simpanAbsen/{{  Crypt::encrypt($absensi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="keterangan" value="Alpha">
                  <br>
                  <div class="mb-3">
                    <label for="simpleinput" class="form-label">Alasan terlambat</label>
                    <input type="text" id="simpleinput" name="alasan" class="form-control">
                </div>
                <button type="submit" class="btn btn-info">Kirim</button>
                </form>
              </div>
            @elseif($localtime <= $absensi->TMabsen->jam_mulai)
              <div class="card-body">
                <h2 class="text-center text-warning">Absensi belum dibuka</h2>
              </div>
            @else
            <div class="card-body">
              <form action="/simpanAbsen/{{  Crypt::encrypt($absensi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="example-select" class="form-label">Keterangan</label>
                    <select class="form-select" name="keterangan" id="example-select">
                      <option selected disabled>Keterangan</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Ijin">Ijin</option>
                    </select>
                </div> 
                <button type="submit" class="btn btn-primary">Absen</button>
              </form>
            </div>
            @endif
            
            <!-- /.card-header -->
            {{-- @if($localtime != $absensi->TMabsen->jam_mulai && $localtime >= $absensi->TMabsen->jam_akhir )
              <div class="card-body">
                <h2 class="text-center text-danger">Maaf, Anda terlambat</h2>
                <form action="/simpanAbsen/{{  Crypt::encrypt($absensi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="keterangan" value="Alpha">
                  <br>
                  <div class="mb-3">
                    <label for="simpleinput" class="form-label">Alasan terlambat</label>
                    <input type="text" id="simpleinput" name="alasan" class="form-control">
                </div>
                <button type="submit" class="btn btn-info">Kirim</button>
                </form>
              </div>
            @elseif(  $localtime >= $absensi->TMabsen->jam_mulai )
              <div class="card-body">
                <form action="/simpanAbsen/{{  Crypt::encrypt($absensi->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                      <label for="example-select" class="form-label">Keterangan</label>
                      <select class="form-select" name="keterangan" id="example-select">
                        <option selected disabled>Keterangan</option>
                          <option value="Hadir">Hadir</option>
                          <option value="Sakit">Sakit</option>
                          <option value="Ijin">Ijin</option>
                      </select>
                  </div> 
                  <button type="submit" class="btn btn-primary">Absen</button>
                </form>
              </div>
            @elseif($localtime >= $absensi->TMabsen->jam_mulai && $localtime != $tanggal)
              <div class="card-body">
                <h2 class="text-center text-warning">Tanggal absen tidak sesuai</h2>
              </div>
            @elseif($localtime <= $absensi->TMabsen->jam_mulai )
              <div class="card-body">
                <h2 class="text-center text-warning">Absensi belum dibuka</h2>
              </div>
          
            @endif --}}
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