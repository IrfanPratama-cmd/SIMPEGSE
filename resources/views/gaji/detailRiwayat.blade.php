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
        <h2>Rekap Gaji</h2>
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="/gajiPegawai" class="nav-link ">
                   Bulan ini
                </a>
            </li>
            <li class="nav-item">
                <a href="/rekapGajiPegawai" class="nav-link active">
                    Rekap Gaji
                </a>
            </li>
        </ul> <!-- end nav-->
        {{-- <a href="/tambahDivisi" class="btn btn-success">Tambah Divisi</a> --}}
        <div class=" d-lg-block col-4">
            <form action="/bulanGajiPegawai" method="GET">
                <div class="input-group">
                    <select class="form-select" name="bulan" id="example-select">
                        <option selected disabled>Pilih Bulan</option>
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                      </select>
                      <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div><br>
        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Golongan Guru</th>
                    <th>Tanggal gaji</th>
                    <th>Gaji Pokok</th>
                    <th>Total Gaji</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($gaji as $g)
                    <tr>
                        <td>{{ $g->pegawai->nama_lengkap }}</td>
                        <td>{{ $g->pegawai->golongan_guru }}</td>
                        <td>{{ $g->tanggal_penggajian }}</td>
                        <td>Rp. {{number_format($g->gaji_pokok ) }}</td>
                        <td>Rp. {{number_format($g->total_gaji ) }}</td>
                        <td>{{ $g->status }}</td>
                        <td>
                            <a href="/detailGajiPegawai/{{  Crypt::encrypt($g->id) }}" class="btn-sm btn-info">Detail </a>
                            <form action="/hapusGaji/{{  Crypt::encrypt($g->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                                  </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $gaji->links() }}
    </div>
</div>


<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection