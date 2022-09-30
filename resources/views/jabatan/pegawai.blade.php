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

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Jabatan</li>
                </ol>
            </div>
            <h2>Data Jabatan {{ $nama_sekolah }}</h2>
        </div>
    </div>
</div>   

<div class="card">
    <div class="card-body">
        <h2>Data Jabatan</h2>
        {{-- <a href="/tambahDivisi" class="btn btn-success">Tambah Divisi</a> --}}
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Tambah Jabatan</button>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    {{-- <th>Gaji Pokok</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($jabatan as $j)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->pegawai->nama_lengkap }}</td>
                    <td>{{ $j->jabatan->nama_jabatan }}</td>
                    {{-- <td>Rp. {{ number_format($j->jabatan->gaji_pokok) }}</td> --}}
                    
                    <td> 
                        <form action="/hapusJabatanPegawai/{{  Crypt::encrypt($j->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                        <a href="/editJabatanPegawai/{{ Crypt::encrypt($j->id) }}" class="btn-sm btn-info">Edit</a>
                        <a href="/detailJabatanPegawai/{{ Crypt::encrypt($j->id) }}" class="btn-sm btn-success">Detail</a>
                          {{-- <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#fill-danger-modal">Hapus</button> --}}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $jabatan->links() }}
    </div>
</div>


<div id="buat-absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="buat-absenLabel">Tambah Jabatan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahJabatanPegawai" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Pilih Pegawai</label>
                                    <select class="form-select" name="pegawai_id" id="example-select">
                                      <option selected disabled>Pilih Pegawai</option>
                                        @foreach($pegawai as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Pilih Jabatan</label>
                                        <select class="form-select" name="jabatan_id" id="example-select">
                                          <option selected disabled>Pilih Jabatan</option>
                                            @foreach($TMjabatan as $j)
                                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                            @endforeach
                                        </select>
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

<div id="fill-danger-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-header">
                <h4 class="modal-title" id="fill-danger-modalLabel">Danger Filled Modal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Apa anda yakin mau menghapus ini?
            </div>
            {{-- <form action="/hapusDivisi/{{  Crypt::encrypt($d->id) }}" method="post">
                @method('delete')
                @csrf --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light">Hapus Data</button>
                </div>
            {{-- </form> --}}
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