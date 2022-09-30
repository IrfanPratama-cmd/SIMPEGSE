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
        <h2>Data Pegawai {{ $nama_sekolah }}</h2>
        <a href="/tambahUser" class="btn btn-success">Tambah User</a>
        <br><br>
        <div class="app-search dropdown d-none d-lg-block col-4">
            <form action="/cariPegawai" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="cariPegawai" value="{{ old('cariPegawai') }}"  placeholder="Search Pegawai" id="top-search">
                    <span class="mdi mdi-magnify search-icon"></span>
                    <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Nama Lengkap</th>
                    <th>Golongan</th>
                    <th>Tanggal Masuk</th>
                    <th>Masa Kerja</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($pegawai as $p)
                <?php 
                    $diff = date_diff( $p->created_at, $tanggal );
                ?>
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->golongan_guru }}</td>
                    <td>{{ $p->created_at->format('Y-m-d') }}</td>
                    <td>{{ $diff->y }} Tahun {{ $diff->m }} Bulan</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <a href="/detailPegawai/{{  Crypt::encrypt($p->id) }}" class="btn-sm btn-info">Detail</a>
                        <a href="/editPegawaiAdmin/{{ Crypt::encrypt($p->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deletePegawai/{{  Crypt::encrypt($p->id) }}" method="post" class="d-inline">
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
        {{ $pegawai->links() }}
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection