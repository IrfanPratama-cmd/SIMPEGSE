@extends('admin.main')

@section('container')


<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Detail Jabatan</h1>
          <hr>
          <div class="card mt-2">
            
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <td width="40%"><h4> Nama Divisi </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4> {{ $jabatan->divisi->nama_divisi }} </h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Jabatan </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>{{ $jabatan->nama_jabatan }}</h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Gaji Pokok </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->gaji_pokok)  }} </h4></td>
                  </tr>
                  {{-- <tr>
                    <td width="40%"><h4> Tunjangan Jabatan </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->tunjangan_jabatan)  }} </h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Tunjangan Pasangan </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->tunjangan_pasangan)  }} </h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Tunjangan Anak </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->tunjangan_anak)  }} </h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Tunjangan Makan per hari </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->tunjangan_makan_perhari)  }} </h4></td>
                  </tr>
                  <tr>
                    <td width="40%"><h4> Tunjangan Transport per hari </h4></td>
                    <td width="20%"><h4>:</h4></td>
                    <td><h4>Rp. {{ number_format($jabatan->tunjangan_transport_perhari)  }} </h4></td>
                  </tr> --}}
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