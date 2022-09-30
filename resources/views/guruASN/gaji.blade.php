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

<div class="row justify-content-center">
  <div class="card col-lg-8 ">
    <div class="card-body">
        <h2>Input Gaji Pegawai</h2>
        <hr>
        <div class="tab-content">
          <div class="tab-pane show active" id="input-types-preview">
              <div class="row ">
                <form action="/simpanGajiPNS" method="POST">
                  @csrf
                  <div class="col-lg-12">
                          <div class="mb-3">
                              <label for="simpleinput" class="form-label">Nama Pegawai</label>
                              <input type="text" id="simpleinput" name="name" class="form-control" value="{{ $gaji->pegawai->nama_lengkap }}" readonly>
                          </div>

                          <input type="hidden" name="pegawai_id" value="{{ $gaji->pegawai_id }}">
                          
                          <input type="hidden" name="user_id" value="{{ $gaji->pegawai->user_id }}">
                          
                          <input type="hidden" name="gaji_pokok" value="{{ $gaji->skhasn->gaji_asn }}">

                          <div class="mb-3">
                              <label for="example-email" class="form-label">Gaji Pokok</label>
                              <input type="text" id="example-email" class="form-control" value="Rp. {{ number_format($gaji->skhasn->gaji_asn)  }}" readonly>
                          </div>  
                          
                          <div class="mb-3">
                            <label for="example-email" class="form-label">Golongan PNS</label>
                            <input type="text" id="example-email" class="form-control" value="{{ $gaji->skhasn->asn->golongan_asn}}" readonly>
                        </div>
                 
                        <div class="mb-3">
                          <label for="tanggal_penggajian" class="form-label">Tanggal Penggajian</label>
                          <input type="date" class="form-control @error('tanggal_penggajian') is-invalid @enderror" id="tanggal_penggajian" 
                          name="tanggal_penggajian"  required autofocus>
                          <span id="tanggal_penggajian" class="alert-message"></span>
                          @error('tanggal_penggajian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>    
                          @enderror          
                      </div>
                        <button type="submit" class="btn btn-success">Tambah User</button>                                                      
                </div> <!-- end col -->
              </form>
    </div>
</div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection