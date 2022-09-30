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
        <h2>Riwayat Gaji Pegawai</h2>
    
       
        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Riwayat Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($riwayat as $g)
                    <tr>
                        <td>{{ $g->pegawai->nama_lengkap }}</td>
                        <td>{{ $g->pegawai->golongan_guru }}</td>
                        <td>{{ $g->total }}</td>
                        <td>
                            <a href="/detailRiwayatGaji/{{  Crypt::encrypt($g->id) }}" class="btn-sm btn-info">Detail </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $riwayat->links() }}
    </div>
</div>


<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection