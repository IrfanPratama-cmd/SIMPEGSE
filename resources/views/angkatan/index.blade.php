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
        <h2>Data Angkatan Siswa {{ $nama_sekolah }}</h2>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Tambah Angkatan</button>
        {{-- <div class="app-search dropdown d-none d-lg-block col-4">
            <form action="/cariAngkatan" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="cariAngkatan" value="{{ old('cariAngkatan') }}"  placeholder="Search Pegawai" id="top-search">
                    <span class="mdi mdi-magnify search-icon"></span>
                    <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div> --}}
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    {{-- <th>No. </th> --}}
                    <th>Angkatan</th>
                    <th>Jumlah Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($count as $a)
                <tr class="text-center">
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $a->angkatan->angkatan }}</td>
                    <td>{{ $a->total }}</td>
                    {{-- <td>{{ $p->status }}</td> --}}
                    <td>
                        <a href="/editAngkatan/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAngkatan/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @foreach ($angkatan as $a)
                <tr class="text-center">
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $a->angkatan }}</td>
                    <td>0</td>
                    {{-- <td>{{ $p->status }}</td> --}}
                    <td>
                        <a href="/editAngkatan/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAngkatan/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
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
        {{-- {{ $angkatan->links() }} --}}
    </div>
</div>

<div id="buat-absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="buat-absenLabel">Tambah Angkatan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahAngkatan" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="number" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" 
                                    name="angkatan"  required autofocus>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('angkatan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection