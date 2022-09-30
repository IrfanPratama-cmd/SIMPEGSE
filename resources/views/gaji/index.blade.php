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
        <h2>Data Gaji Bulan {{ $tanggal }}</h2>
        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="/gajiPegawai" class="nav-link active">
                   Bulan ini
                </a>
            </li>
            <li class="nav-item">
                <a href="/rekapGajiPegawai" class="nav-link">
                    Rekap Gaji
                </a>
            </li>
        </ul> <!-- end nav-->
        {{-- <a href="/tambahDivisi" class="btn btn-success">Tambah Divisi</a> --}}
        {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Tambah Gaji</button> --}}
        <hr>    
        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    {{-- <th>No.</th> --}}
                    <th>Nama Pegawai</th>
                    <th>Golongan Guru</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tanggal Penggajian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($gaji as $g)
                    <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $g->nama_lengkap }}</td>
                        <td>{{ $g->golongan_guru}}</td>
                        <td>{{ $g->nama_jabatan}}</td>
                        <td>Rp. {{number_format($g->gaji_pokok ) }}</td>
                        <td>{{ $g->tanggal_penggajian }}</td>
                        <td>{{ $g->status }}</td>
                        <td>
                            <a href="/detailGajiPegawai/{{  Crypt::encrypt($g->id) }}" class="btn-sm btn-info">Detail </a>
                            <form action="/hapusGajiPegawai/{{  Crypt::encrypt($g->id) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                                  </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @foreach($asn as $a)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $a->nama_lengkap }}</td>
                    <td>{{ $a->golongan_guru }}</td>
                    <td>{{ $a->nama_jabatan }}</td>
                    <td>Rp.{{ number_format($a->gaji_asn ) }}</td>
                    <td>Belum Ditentukan</td>
                    <td>-</td>
                    <td>
                        <a href="/inputGajiPNS/{{  Crypt::encrypt($a->id) }}" class="btn-sm btn-success">Input </a>
                    </td>
                </tr>
                @endforeach
                @foreach($pppk as $p)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->golongan_guru }}</td>
                    <td>{{ $p->nama_jabatan }}</td>
                    <td>Rp. {{ number_format($p->gaji_pppk) }}</td>
                    <td>Belum Ditentukan</td>
                    <td>-</td>
                    <td>
                        <a href="/inputGajiPPPK/{{  Crypt::encrypt($p->id) }}" class="btn-sm btn-success">Input </a>
                    </td>
                </tr>
                @endforeach
                @foreach($honorer as $h)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $h->nama_lengkap }}</td>
                    <td>{{ $h->golongan_guru }}</td>
                    <td>{{ $h->nama_jabatan }}</td>
                    <td>Rp. {{ number_format($h->gaji_pokok)  }}</td>
                    <td>Belum Ditentukan</td>
                    <td>-</td>
                    <td>
                        <a href="/inputGajiHonorer/{{  Crypt::encrypt($h->id) }}" class="btn-sm btn-success">Input </a>
                    </td>
                </tr>
                @endforeach
                @foreach($ps as $p)
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->golongan_guru }}</td>
                    <td>{{ $p->nama_jabatan }}</td>
                    <td>Rp. {{ number_format($p->gaji_pokok)}}</td>
                    <td>Belum Ditentukan</td>
                    <td>-</td>
                    <td>
                        <a href="/inputGajiPegawai/{{  Crypt::encrypt($p->id) }}" class="btn-sm btn-success">Input </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $gaji->links() }}
    </div>
</div>


{{-- <div id="buat-absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="buat-absenLabel">Tambah Gaji</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahGajiPegawai" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Pilih Pegawai</label>
                                    <select class="form-select" name="pegawai_id" id="example-select">
                                      <option selected disabled>Pilih Pegawai</option>
                                      @foreach ($pegawai as $p)
                                        @if(old('pegawai_id') == $p->id)
                                            <option value="{{ $p->id}}" selected>{{ $p->nama_lengkap}}</option>
                                        @else
                                            <option value="{{ $p->id}}">{{ $p->nama_lengkap}}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                </div> 
                                <div class="mb-3">
                                    <label for="tanggal_penggajian" class="form-label">Tanggal Penggajian</label>
                                    <input type="date" class="form-control @error('tanggal_penggajian') is-invalid @enderror" id="tanggal_penggajian" 
                                    name="tanggal_penggajian"  required autofocus>
                                    <span id="gaji-pokokError" class="alert-message"></span>
                                    @error('tanggal_penggajian')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror          
                                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> --}}

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection