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
        <h2>Data Sekolah</h2>
        {{-- <button type="button" classs="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Tambah Angkatan</button> --}}
        <div class="app-search dropdown d-none d-lg-block col-4">
            <form action="/cariSekolah" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="cariSekolah" value="{{ old('cariSekolah') }}"  placeholder="Search Sekolah" id="top-search">
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
                    <th>Nama Sekolah</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($sekolah as $s)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_sekolah }}</td>
                    <td>{{ $s->user->email }}</td>
                    <td>{{ $s->no_telp }}</td>
                    {{-- <td>{{ $p->status }}</td> --}}
                    <td>
                        <a href="/detailSekolah/{{ Crypt::encrypt($s->id) }}" class="btn-sm btn-success">Detail</a>
                        {{-- <form action="/deleteAngkatan/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $angkatan->links() }} --}}
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection