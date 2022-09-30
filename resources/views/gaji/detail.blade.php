@extends('admin.main')

@section('container')

<script src="{{ asset('js/jam.js') }}"></script>

<?php 
  $tunjangan_makan = $gaji->jabatan->tunjangan_makan_perhari * $hadir;
  $tunjangan_transport = $gaji->jabatan->tunjangan_transport_perhari;
  
?>

<section class="content" onload="realtimeClock()">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Detail Gaji {{ $gaji->pegawai->nama_lengkap }}</h1>
          <hr>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              {{-- <h2 class="text-center text-success">Anda Sudah Presensi</h2> --}}

              <table class="table">
                <tbody>
                  <tr>
                    <td width="30%"><h4> Nama Pegawai </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4> {{ $gaji->pegawai->nama_lengkap }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Divisi </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4> {{ $gaji->divisi->nama_divisi }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Jabatan </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4> {{ $gaji->jabatan->nama_jabatan }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Tanggal Gaji </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>{{ $gaji->tanggal_penggajian }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Gaji Pokok </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($gaji->jabatan->gaji_pokok) }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Tunjangan Jabatan </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($gaji->jabatan->tunjangan_jabatan) }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Tunjangan Makan </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($gaji->jabatan->tunjangan_makan_perhari) }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Tunjangan Transport </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($gaji->jabatan->tunjangan_transport_perhari) }} </h4></td>
                  </tr>
                  <tr>
                    <td width="30%"><h4> Gaji Bersih </h4></td>
                    <td width="5%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($gaji->jabatan->tunjangan_transport_perhari + $gaji->jabatan->gaji_pokok + $gaji->jabatan->tunjangan_jabatan + $gaji->jabatan->tunjangan_makan_perhari) }} </h4></td>
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