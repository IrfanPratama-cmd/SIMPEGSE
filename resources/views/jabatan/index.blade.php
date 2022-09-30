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
                    <th>Nama Jabatan</th>
                    {{-- <th>Gaji Pokok</th> --}}
                    {{-- <th>Tunjangan Pasangan</th>
                    <th>Tunjangan Anak</th>
                    <th>Tunjangan Transport</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($jabatan as $j)
                <tr class="text-center">
                    <td>{{ $j->nama_jabatan }}</td>
                    {{-- <td>Rp. {{ number_format($j->gaji_pokok)  }}</td> --}}
                    {{-- <td>Rp. {{ number_format($j->tunjangan_pasangan)  }}</td>
                    <td>Rp. {{ number_format($j->tunjangan_anak) }}</td>
                    <td>Rp. {{ number_format($j->tunjangan_transport) }}</td> --}}
                    <td> 
                        <form action="/hapusJabatan/{{  Crypt::encrypt($j->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                        <a href="/editJabatan/{{ Crypt::encrypt($j->id) }}" class="btn-sm btn-info">Edit</a>
                        {{-- <a href="/detailJabatan/{{ Crypt::encrypt($j->id) }}" class="btn-sm btn-success">Detail</a> --}}
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
            <form action="/tambahJabatan" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" 
                                    name="nama_jabatan"  required autofocus>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('nama_jabatan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_jabatan" class="form-label">Jabatan Dimiliki Banyak User ?</label>
                                    <div class="form-check">
                                        <input type="radio" id="customRadio1" name="is_many" value="1" class="form-check-input">
                                        <label class="form-check-label" for="customRadio1">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="customRadio2" name="is_many" value="0" class="form-check-input">
                                        <label class="form-check-label" for="customRadio2">Tidak</label>
                                    </div>
                                </div> 
                                {{-- <div class="mb-3">
                                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                                    <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" 
                                    name="gaji_pokok"  required autofocus>
                                    <span id="gaji-pokokError" class="alert-message"></span>
                                    @error('gaji_pokok')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>   --}}
                                {{-- <div class="mb-3">
                                    <label for="tunjangan_anak" class="form-label">Tunjangan Anak</label>
                                    <input type="number" class="form-control @error('tunjangan_anak') is-invalid @enderror" id="tunjangan_anak" 
                                    name="tunjangan_anak"  required autofocus>
                                    <span id="tunjangan-jabatanError" class="alert-message"></span>
                                    @error('tunjangan_anak')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>       
                                <div class="mb-3">
                                    <label for="tunjangan_pasangan" class="form-label">Tunjangan Pasangan</label>
                                    <input type="number" class="form-control @error('tunjangan_pasangan') is-invalid @enderror" id="tunjangan_pasangan" 
                                    name="tunjangan_pasangan"  required autofocus>
                                    <span id="tunjangan-jabatanError" class="alert-message"></span>
                                    @error('tunjangan_pasangan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>               
                                <div class="mb-3">
                                    <label for="tunjangan_transport" class="form-label">Tunjangan Transport per Hari</label>
                                    <input type="number" class="form-control @error('tunjangan_transport') is-invalid @enderror" id="tunjangan_transport" 
                                    name="tunjangan_transport"  required autofocus>
                                    <span id="tunjangan-transport-perhariError" class="alert-message"></span>
                                    @error('tunjangan_transport')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>                --}}
                    
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