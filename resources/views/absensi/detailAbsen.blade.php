@extends('admin.main')

@section('container')


<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Absen Pegawai</h1>
          <hr>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <h2 class="text-center text-success">Anda Sudah Presensi</h2>

              <table class="table">
                <tbody>
                  <tr>
                    <td width="30%"><h4> Jam Absen </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4> {{ $absensi->jam_absen }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Tanggal Absensi </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>{{ $absensi->TMabsen->hari }},  {{ $absensi->TMabsen->tanggal }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Nama Pegawai </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>{{ $absensi->pegawai->nama_lengkap }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Keterangan </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>{{ $absensi->keterangan}} </h4></td>
                  </tr>
                </tbody>

              </table>

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