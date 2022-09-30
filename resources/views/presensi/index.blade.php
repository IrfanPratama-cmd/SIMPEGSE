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

<body onload="realtimeClock()">

  <h1>Presensi Pegawai</h1>

<div class="card">
    <div class="card-body">
        

        <ul class="nav nav-tabs nav-bordered mb-3">
          <li class="nav-item">
              <a href="/absensi-pegawai" class="nav-link active">
                  Presensi
              </a>
          </li>
          <li class="nav-item">
              <a href="/ijin" class="nav-link">
                  Izin
              </a>
          </li>
          <li class="nav-item">
            <a href="/rekapPresensi" class="nav-link">
                 Rekap
            </a>
        </li>
      </ul> <!-- end nav-->

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

        @endif
    </div>
</div>

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

@endsection