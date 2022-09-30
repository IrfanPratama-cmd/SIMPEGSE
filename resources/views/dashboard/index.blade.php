@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Hello, Selamat Datang {{ auth()->user()->name }}</h1><br>



@if(auth()->user()->role == "Admin")
    <div class="row">
      <div class="col-3">
        <div class="card tilebox-one">
          <div class="card-body">
              <i class="uil uil-users-alt float-end"></i>
              <h6 class="text-uppercase mt-0">Data User</h6>
              <h2 class="my-2" id="active-users-count">{{ $dataUser }}</h2>
          </div> <!-- end card-body-->
        </div>
      </div>

      <div class="col-3">
        <div class="card tilebox-one">
          <div class="card-body">
              <i class="uil uil-users-alt float-end"></i>
              <h6 class="text-uppercase mt-0">Data Pegawai</h6>
              <h2 class="my-2" id="active-users-count">{{ $dataPegawai }}</h2>
          </div> <!-- end card-body-->
        </div>
      </div>

      <div class="col-3">
        <div class="card tilebox-one">
          <div class="card-body">
              <i class="uil uil-window-restore float-end"></i>
              <h6 class="text-uppercase mt-0">Data Siswa</h6>
              <h2 class="my-2" id="active-views-count">{{ $siswa }}</h2>
          </div> <!-- end card-body-->
        </div>
      </div>

      <div class="col-3">
        <div class="card tilebox-one">
          <div class="card-body">
              <i class="uil uil-window-restore float-end"></i>
              <h6 class="text-uppercase mt-0">Data Jabatan</h6>
              <h2 class="my-2" id="active-views-count">{{ $dataJabatan }}</h2>
          </div> <!-- end card-body-->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2>Presensi Hari Ini {{ $tanggal }}</h2>
            <hr>
            <div class="row">
              @if($tanggal == $minggu || $tanggal == $sabtu)
                <h2 class="text-center">Hari ini libur !</h2>
              @else
                <div class="col-xxl-6 col-lg-6">
                    <div class="card widget-flat bg-success text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                            </div>
                            <h2 class=" mt-0" title="Customers">Presensi Hari Ini</h2>
                            <h4 class="mt-3 mb-3">{{ $pegawaiPresensi }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6">
                    <div class="card widget-flat bg-warning text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-white text-warning"></i>
                            </div>
                            <h2 class=" mt-0" title="Customers">Belum Presensi</h2>
                            <h4 class="mt-3 mb-3">{{ $blmPresensi }}</h4>
                        </div>
                    </div>
                </div>
              @endif
          </div>
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2>Gaji bulan {{ $bulan }}</h2>
            <hr>
            <div class="row">
            
                <div class="col-xxl-6 col-lg-6">
                    <div class="card widget-flat bg-info text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-white text-info"></i>
                            </div>
                            <h2 class=" mt-0" title="Customers">Sudah di Bayar</h2>
                            <h4 class="mt-3 mb-3">{{ $gajiDibayar }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-6">
                    <div class="card widget-flat bg-danger text-white">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon bg-white text-danger"></i>
                            </div>
                            <h2 class=" mt-0" title="Customers">Belum di Bayar</h2>
                            <h4 class="mt-3 mb-3">{{ $gajiBlmDibayar }}</h4>
                        </div>
                    </div>
                </div>
          </div>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2>Pengajuan Cuti</h2>
            <hr>
            <div class="row">
            
              <div class="col-4">
                <div class="card tilebox-one bg-info">
                  <div class="card-body">
                      <i class="uil uil-users-alt float-end text-white"></i>
                      <h6 class="text-uppercase mt-0 text-white">Menunggu</h6>
                      <h2 class="my-2 text-white" id="active-users-count">{{ $pengajuanCuti }}</h2>
                  </div> <!-- end card-body-->
                </div>
              </div>

              <div class="col-4">
                <div class="card tilebox-one bg-success">
                  <div class="card-body">
                      <i class="uil uil-users-alt float-end text-white"></i>
                      <h6 class="text-uppercase mt-0 text-white">Disetujui</h6>
                      <h2 class="my-2 text-white" id="active-users-count">{{ $terimaCuti }}</h2>
                  </div> <!-- end card-body-->
                </div>
              </div>

              <div class="col-4">
                <div class="card tilebox-one bg-warning">
                  <div class="card-body">
                      <i class="uil uil-users-alt float-end text-white"></i>
                      <h6 class="text-uppercase mt-0 text-white">Ditolak</h6>
                      <h2 class="my-2 text-white" id="active-users-count">{{ $tolakCuti }}</h2>
                  </div> <!-- end card-body-->
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
 
@elseif(auth()->user()->role == "Siswa")

    <h3>Siswa {{ $nama_sekolah }}</h3>



@elseif(auth()->user()->role == "Pegawai")

    <h3>Karyawan {{ $nama_sekolah }}</h3>

    <div class="card">

    <div class="card-body">
      <h1>Data Diri</h1>

        
        <hr>
        <div class="row">
            <div class="col-md-3">
                @if($pegawai >= 1)
                    <div class="card border-success border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-success">Profile</h4>
                            <div class="d-grid">
                                <a href="/profilePegawai" class="btn btn-success btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @else
                    <div class="card border-secondary border">
                        <div class="card-body">
                            <h4 class="card-title text-center">Profile</h4>
                            <div class="d-grid">
                                <a href="/profilePegawai" class="btn btn-secondary btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @endif
            </div> <!-- end col-->
        
            <div class="col-md-3">
                @if($ortu >= 1 && $anak >= 1)
                    <div class="card border-success border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-success">Data Keluarga</h4>
                        <div class="d-grid">
                            <a href="/data-keluarga" class="btn btn-success btn-sm">Button</a>
                        </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @else
                    <div class="card border-secondary border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-secondary">Data Keluarga</h4>
                        <div class="d-grid">
                            <a href="/data-keluarga" class="btn btn-secondary btn-sm">Button</a>
                        </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @endif
            </div> <!-- end col-->
        
            <div class="col-md-3">
                @if($pendidikan >= 1)
                    <div class="card border-success border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-success">Riwayat Pendidikan</h4>
                            <div class="d-grid">
                                <a href="/pendidikan" class="btn btn-success btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @else
                    <div class="card border-secondary border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-secondary">Riwayat Pendidikan</h4>
                            <div class="d-grid">
                                <a href="/pendidikan" class="btn btn-secondary btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @endif
            </div> <!-- end col-->
        
            <div class="col-md-3">
                @if($organisasi >= 1)
                    <div class="card border-success border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-success">Riwayat Organisasi</h4>
                            <div class="d-grid">
                                <a href="/riwayatorganisasi" class="btn btn-success btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @else
                    <div class="card border-secondary border">
                        <div class="card-body">
                            <h4 class="card-title text-center text-secondary">Riwayat Organisasi</h4>
                            <div class="d-grid">
                                <a href="/riwayatorganisasi" class="btn btn-secondary btn-sm">Button</a>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                @endif
            </div> <!-- end col-->
        </div>
    </div>
    </div>
    <body onload="realtimeClock()">

      

    <div class="card">
        <div class="card-body">

          <div class="row">
            <h2>Presensi {{ $tanggal }}</h2>
          </div>
          <hr>

            <div class="text-center">
                <label id="clock" style="font-size: 80px; color: #0A77DE; -webkit-text-stroke: 3px #00ACFE;
                        text-shadow: 4px 4px 10px #36D6FE,
                        4px 4px 20px #36D6FE,
                        4px 4px 30px#36D6FE,
                        4px 4px 40px #36D6FE;">
                </label>
            </div>

            @if($tanggal == $sabtu || $tanggal == $minggu)
              <h2 class="text-center">Hari ini libur!</h2> <br>
              <h3 class="text-center">{{ $tanggal }}</h3>
              <br><br><br><br><br>
            @else
            @foreach ($setting as $s)
                
              @if($cekPresensi >= 1)
                <h2 class="text-center">Anda sudah presensi hari ini</h2>
                <br>
                @foreach($presensi as $p)
                <div class="row justify-content-center">
                  <div class="col-8">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td width="40%"><h4> Nama Pegawai </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td><h4> {{ $p->pegawai->nama_lengkap }} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Tanggal Presensi </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td><h4>{{ $p->tgl }} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Jam Presensi</h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td><h4>{{ $p->jam_presensi }} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Keterangan </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td ><h4>{{ $p->keterangan}} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Jenis Presensi </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          @if($p->status == "Sekolah")
                            <td ><h4>{{ $p->status}} (Onsite) </h4></td> 
                          @elseif($p->status == "Rumah") 
                            <td ><h4>{{ $p->status}} (WFH) </h4></td>
                          @elseif($p->status == "Alpha") 
                            <td ><h4>{{ $p->status}} </h4></td>  
                          @endif
                         
                        </tr>
                        <tr>
                          <td width="40%"><h4> Lokasi Presensi </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td ><h4>{{ $p->cityName }}, {{ $p->regionName }}, {{ $p->countryName }} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Latitude </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td ><h4>{{ $p->latitude }} </h4></td>
                        </tr>
                        <tr>
                          <td width="40%"><h4> Longitude </h4></td>
                          <td width="30%"><h4>:</h4></td>
                          <td ><h4>{{ $p->longitude }} </h4></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                
                </div>
                @endforeach
              @elseif($localtime >= $s->jam_masuk && $localtime <= $s->jam_pulang)
                <h2 class="text-center">Anda Terlambat</h2>
                <div class="text-center">
                  {{-- <form action="/presensi" method="post">
                    @csrf
                    <input type="hidden" name="jam_presensi" value="{{ $localtime }}">
                    <input type="hidden" name="keterangan" value="Terlambat">
                    <button class="btn btn-info">Presensi</button>
                  </form>  --}}
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#presensi">Presensi</button>
                  <br><br><br><br><br><br>
                </div>
              @elseif($localtime >= $s->jam_absen && $localtime <= $s->jam_masuk)
                <h2 class="text-center">Silahkan Absen</h2>
                <div class="text-center">
                  {{-- <form action="/presensi" method="post">
                    @csrf
                    <input type="hidden" name="jam_presensi" value="{{ $localtime }}">
                    <input type="hidden" name="keterangan" value="Hadir">
                    <button class="btn btn-info">Presensi</button>
                  </form> --}}
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#presensi">Presensi</button>
                  <br><br><br><br><br><br>
                </div>
              @elseif($localtime >= $s->jam_masuk && $localtime >= $s->jam_pulang)
                <h2 class="text-center">Di luar Jam Kerja</h2>
              @endif
            
            @endforeach
          </div>
        </div>
  @endif

</body>

<div id="presensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buat-absenLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="buat-absenLabel">Presensi</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
          </div>
          @foreach ($setting as $s)
          <form action="/presensi" method="post">
              <div class="modal-body">
                          @csrf
                          <div class="row">
                              @if($localtime >= $s->jam_masuk && $localtime <= $s->jam_pulang)
                                  <div class="mb-3">
                                    <label for="name" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="name" 
                                    name="keterangan" value="Terlambat" required readonly>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('keterangan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>

                              @elseif($localtime >= $s->jam_absen && $localtime <= $s->jam_masuk)
                                  <div class="mb-3">
                                    <label for="name" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="name" 
                                    name="keterangan" value="Hadir" required readonly>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('keterangan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
                                </div>

                              @endif

                              <div class="mb-3">
                                <label for="name" class="form-label">Jam Presensi</label>
                                <input type="text" class="form-control @error('jam_presensi') is-invalid @enderror" id="name" 
                                name="jam_presensi" value="{{ $localtime }}" required readonly>
                                <span id="nama-jabatanError" class="alert-message"></span>
                                @error('jam_presensi')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>    
                                @enderror
                            </div>

                            <div class="mb-3">
                              <label for="name" class="form-label">Lokasi Presensi</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                               readonly value="{{ $location->cityName }}, {{ $location->regionName }}, {{ $location->countryName }}">
                              <span id="nama-jabatanError" class="alert-message"></span>
                              @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>    
                              @enderror
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Latitude</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                             readonly value="{{ $location->latitude }}">
                            <span id="nama-jabatanError" class="alert-message"></span>
                            @error('name')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>    
                            @enderror
                        </div>

                        <div class="mb-3">
                          <label for="name" class="form-label">Longitude</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                           readonly value="{{ $location->longitude }}">
                          <span id="nama-jabatanError" class="alert-message"></span>
                          @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="example-select" class="form-label">Jenis Presensi</label>
                        <select class="form-select" name="status" id="example-select" ">
                            <option value="Sekolah">Sekolah (Onsite)</option>
                            <option value="Rumah">Rumah (WFH)</option>  
                        </select>
                    </div>

                                   
                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Presensi</button>
              </div>
          </form>
          @endforeach
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="{{ asset('js/jam.js') }}"></script>
@endif

@endsection