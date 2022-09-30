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

        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="/dataGuruASN" class="nav-link">
                   Guru PNS
                </a>
            </li>
            <li class="nav-item">
                <a href="/dataGuruPPPK" class="nav-link">
                   Guru PPPK
                </a>
            </li>
            <li class="nav-item">
                <a href="/dataGuruHonorer" class="nav-link">
                   Guru Honorer
                </a>
            </li>
            <li class="nav-item">
                <a href="/dataPegawaiSekolah" class="nav-link active">
                   Pegawai Sekolah
                </a>
            </li>
        </ul> <!-- end nav-->
           
        <h2>Data Pegawai Sekolah</h2>
        <div class="col-lg-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Gaji Pegawai </button>
        </div>   
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Nama Pegawai</th>
                    <th>Golongan</th>
                    <th>Jabatan</th>
                    {{-- <th>Masa Jabatan</th> --}}
                    <th>Gaji Pokok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach($guru as $g)
                <tr class="text-center">
                    <td>{{ $g->nama_lengkap }}</td>
                    <td>{{ $g->golongan_guru }}</td>
                    <td>{{ $g->nama_jabatan }}</td>
                    {{-- <td>{{ $diff->y }} Tahun {{ $diff->m }} Bulan</td> --}}
                    <td>Rp. {{ number_format($g->gaji_pokok) }}</td>
                    <td>
                        <a href="/editPegawaiSekolah/{{ Crypt::encrypt($g->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/hapusPegawaiSekolah/{{  Crypt::encrypt($g->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @foreach ($pegawai as $p)
                <tr class="text-center">
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->golongan_guru }}</td>
                    <td>{{ $p->nama_jabatan }}</td>
                    {{-- <td>{{ $p->created_at }}</td> --}}
                    {{-- <td>{{ $diff->y }} Tahun {{ $diff->m }} Bulan</td> --}}
                    <td>Belum Ada</td>
                    <td>
                        {{-- <a href="/editAsn/{{ Crypt::encrypt($p->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAsn/{{  Crypt::encrypt($p->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form> --}} Belum Input
                    </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        {{-- {{ $angkatan->links() }} --}}
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambahLabel">Tambah Gaji Pegawai Sekolah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahGajiPegawaiSekolah" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Pilih Pegawai</label>
                                    <div class="input-group">
                                        <select class="form-select" name="pegawai_id" id="example-select">
                                            <option selected disabled>Pilih Pegawai</option>
                                                @foreach ($pegawai as $p)
                                                    <option value="{{ $p->pegawai_id }}">{{ $p->nama_lengkap }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="mb-3">
                                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" 
                                    name="gaji_pokok"  required autofocus>
                                    <span id="gaji-pokokError" class="alert-message"></span>
                                    @error('gaji_pokok')
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