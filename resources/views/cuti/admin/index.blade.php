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
        <h2>Pengajuan Cuti</h2>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Cuti</th>
                    <th>Lama Cuti</th>
                    <th>Alasan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Bukti Pendukung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($cuti as $c)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->pegawai->nama_lengkap }}</td>
                    <td>{{ $c->jenis_cuti }}</td>
                    <td>{{ $c->brp_hari }} Hari</td>
                    <td>{{ $c->alasan }}</td>
                    <td>{{ $c->tgl_mulai }} - {{ $c->tgl_selesai }}</td>
                    <td>{{ $c->status }}</td>
                    <td><a href="/downloadBuktiCuti/{{ $c->bukti_cuti }}">{{ $c->bukti_cuti }}</a></td>
                    <td> 
                        @if($c->status == "Disetujui")
                            <a href="/downloadSurat/{{ Crypt::encrypt($c->id) }}" class="btn-sm btn-info">Download Surat</a>
                        @else
                            <form action="/tolakCuti/{{  $c->id }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button class="btn-sm btn-danger border-0">Tolak
                                </button>
                            </form>
                            <form action="/terimaCuti/{{ $c->id }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button class="btn-sm btn-info border-0">Setuju
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <br><br>
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection