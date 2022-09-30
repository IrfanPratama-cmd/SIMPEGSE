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
        <h2>Data Absen</h2>
        {{-- <a href="/tambahDivisi" class="btn btn-success">Tambah Divisi</a> --}}
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Buat Absen</button>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Akhir</th>
                    <th>Aksi</th>
                    <th>Rekap Absensi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($absensi as $a)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->hari }}</td>
                    <td>{{ $a->tanggal }}</td>
                    <td>{{ $a->jam_mulai }}</td>
                    <td>{{ $a->jam_akhir }}</td>
                    <td> 
                        <form action="/hapusAbsen/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                        <a href="/editAbsen/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-info">Edit</a>
                          {{-- <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#fill-danger-modal">Hapus</button> --}}
                    </td>
                    <td>
                        <a href="/rekapAbsen/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-success">Rekap</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>


<div id="buat-absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="buat-absenLabel">Buat Absen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/buatAbsen" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <div class="">
                                        <label for="example-select" class="form-label">Hari</label>
                                        <select class="form-select" name="hari" id="example-select">
                                          <option selected disabled>Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" 
                                    name="tanggal" required autofocus>
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>    
                                    @enderror
                                </div> --}}
                                <div class="mb-3">
                                    <label class="form-label">Jam Mulai</label>
                                    <div class="input-group" id="jam_mulai">
                                        <input id="jam_mulai" type="time" class="form-control" name="jam_mulai" data-provide="jam_mulai">
                                        <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jam Akhir</label>
                                    <div class="input-group" id="jam_akhir">
                                        <input id="jam_akhir" type="time" class="form-control" name="jam_akhir" data-provide="jam_akhir">
                                        <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                    </div>
                                </div>
                                @foreach($pegawai as $p)
                                    <input type="hidden" name="pegawai_id[]" value="{{ $p }}">
                                @endforeach
                                @foreach($user as $u)
                                    <input type="hidden" name="user_id[]" value="{{ $u }}">
                                @endforeach
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