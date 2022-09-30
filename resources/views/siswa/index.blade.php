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
        <h2>Data Siswa {{ $nama_sekolah }}</h2>
      
        <div class="row">
            <div class="col-lg-8">
                <div class="app-search dropdown d-none d-lg-block col-8">
                    <form action="/cariSiswa" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="cariSiswa" value="{{ old('cariSiswa') }}"  placeholder="Search Siswa" id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <form action="/cariSiswa" method="GET">
                    <div class="input-group">
                        <select class="form-select" name="filter" id="example-select">
                            <option selected disabled>Pilih Angkatan</option>
                                @foreach ($angkatan as $a)
                                    <option value="{{ $a->id }}">{{ $a->angkatan }}</option>
                                @endforeach
                              
                          </select>
                          <button class="input-group-text btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            
        </div>
        <br>
        <div class="col-lg-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#buat-absen">Tambah Siswa</button>
        </div>       
      
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Nama Siswa</th>
                    <th>Angkatan</th>
                    <th>Tahun Lulus</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($siswa as $s)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_siswa }}</td>
                    <td>{{ $s->angkatan->angkatan }}</td>
                    @if(is_null($s->tahun_lulus))
                        <td>-</td>
                    @else
                        <td>{{ $s->tahun_lulus }}</td>
                    @endif
                    
                    @if(is_null($s->tahun_lulus))
                        <td>Aktif</td>
                    @elseif($tanggal >= $s->tahun_lulus)
                        <td>Sudah Lulus</td>
                    @else
                        <td>Aktif</td>
                    @endif
                    
                    <td>
                        <a href="/detailSiswa/{{  Crypt::encrypt($s->id) }}" class="btn-sm btn-info">Detail</a>
                        <a href="/editSiswa/{{ Crypt::encrypt($s->id) }}" class="btn-sm btn-primary">Edit</a>
                        {{-- <form action="/deleteSiswa/{{  Crypt::encrypt($s->id) }}" method="post" class="d-inline">
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
        {{ $siswa->links() }}
    </div>
</div>

<div id="buat-absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="buat-absenLabel">Tambah Siswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahSiswa" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                                    name="name"  required autofocus>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('name')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Angkatan</label>
                                    <div class="input-group">
                                        <select class="form-select" name="angkatan_id" id="example-select">
                                            <option selected disabled>Pilih Angkatan</option>
                                                @foreach ($angkatan as $a)
                                                    <option value="{{ $a->id }}">{{ $a->angkatan }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Pilih Kelas</label>
                                        <select class="form-select" name="kelas_id" id="example-select">
                                          <option selected disabled>Pilih Kelas</option>
                                            @foreach($kelas as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                </div> --}}
                                <input type="hidden" value="Siswa" name="role">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" 
                                    name="email"  required autofocus>
                                    <span id="gaji-pokokError" class="alert-message"></span>
                                    @error('email')
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