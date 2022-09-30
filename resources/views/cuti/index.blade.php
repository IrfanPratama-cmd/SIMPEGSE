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
        @if ($jml >= $setting)
            <button class="btn btn-success border-0"  onclick="return confirm('Total Cuti Sudah Melebihi Batas')">Pengajuan Cuti
        </button>
        @else
            <a href="/tambahCuti" class="btn btn-success">Pengajuan Cuti</a>
        @endif
        
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Jenis Cuti </th>
                    <th>Lama Cuti</th>
                    <th>Alasan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($cuti as $c)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->jenis_cuti }}</td>
                    <td>{{ $c->brp_hari }} Hari</td>
                    <td>{{ $c->alasan }}</td>
                    <td>{{ $c->tgl_mulai }}</td>
                    <td>{{ $c->tgl_selesai }}</td>
                    <td>{{ $c->status }}</td>
                    <td> 
                        @if($c->status == "Disetujui")
                            <a href="/unduhSurat/{{ Crypt::encrypt($c->id) }}" class="btn-sm btn-info">Download Surat</a>
                        @else
                        <form action="/hapusCuti/{{  Crypt::encrypt($c->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                        <a href="/editCuti/{{ Crypt::encrypt($c->id) }}" class="btn-sm btn-info">Edit</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        <br><br>

        <h4>Jumlah Hari Cuti = {{ $jml }}</h4>
        <h4>Total Cuti Tersisa = {{ $total }}</h4>
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection