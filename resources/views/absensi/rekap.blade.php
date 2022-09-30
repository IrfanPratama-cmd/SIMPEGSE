@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="card">
    <div class="card-body">
        <h2>Rekap Absensi</h2>
        <h4>{{ $absensi->hari }}, {{ $absensi->tanggal }}</h4>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Nama Pegawai</th>
                    <th>Jam Absen</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($absen as $a)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->pegawai->nama_lengkap }}</td>
                    <td>{{ $a->jam_absen }}</td>
                    <td>{{ $a->keterangan }}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection