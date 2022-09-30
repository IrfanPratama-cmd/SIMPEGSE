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

  <h2>Presensi</h2>

<div class="card">
    <div class="card-body">
        

        <ul class="nav nav-tabs nav-bordered mb-3">
          <li class="nav-item">
              <a href="/presensi" class="nav-link">
                  Presensi
              </a>
          </li>
          <li class="nav-item">
              <a href="/ijin" class="nav-link active">
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
        <br>
        <div class="row justify-content-center">
             <div class="col-8">
                 @if($cekIzin >= 1)
                    <h2 class="text-center">Anda izin hari ini</h2>
                    @foreach($izin as $i)
                    <table class="table">
                        <tbody>
                        <tr>
                            <td width="40%"><h4> Nama Pegawai </h4></td>
                            <td width="30%"><h4>:</h4></td>
                            <td><h4> {{ $i->pegawai->nama_lengkap }} </h4></td>
                        </tr>
                        <tr>
                            <td width="40%"><h4> Tanggal Presensi </h4></td>
                            <td width="30%"><h4>:</h4></td>
                            <td><h4>{{ $i->tgl }} </h4></td>
                        </tr>
                        <tr>
                            <td width="40%"><h4> Keterangan</h4></td>
                            <td width="30%"><h4>:</h4></td>
                            <td><h4>{{ $i->keterangan }} </h4></td>
                        </tr>
                        <tr>
                            <td width="40%"><h4> Alasan</h4></td>
                            <td width="30%"><h4>:</h4></td>
                            <td ><h4>{{ $i->alasan}} </h4></td>
                        </tr>
                        <tr>
                            <td width="40%"><h4> Status</h4></td>
                            <td width="30%"><h4>:</h4></td>
                            <td ><h4>{{ $i->status}} </h4></td>
                        </tr>
                        </tbody>
                    </table>
                    @endforeach
                @elseif($cekPresensi >= 1)
                <h2 class="text-center">Anda sudah presensi hari ini</h2>
                <br>
                    @foreach($presensi as $p)
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
                      </tbody>
                    </table>
                  </div>
                 
                </div>
                @endforeach
                @else
                <form action="/inputIzin" method="post" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Keterangan</label>
                        <select class="form-select" name="keterangan" id="example-select">
                          <option selected disabled>Keterangan</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                    <input type="hidden" name="jam_presensi" value="{{ $localtime }}">
                    <input type="hidden" name="tgl" value="{{ $tanggal }}">
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" 
                        name="alasan" value="{{ old('alasan') }}"  required autofocus>
                        @error('alasan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Bukti Pendukung</label>
                        <input type="file" id="example-fileinput" class="form-control" name="bukti">
                    </div> 
                    <button type="submit" class="btn btn-primary">Izin</button>
                  </form>
                  @endif     
            </div>   
        </div>
        
    </div>
</div>

</body>

<script src="{{ asset('js/jam.js') }}"></script>

@endsection