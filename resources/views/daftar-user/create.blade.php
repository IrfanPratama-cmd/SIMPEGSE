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
        <h2>Tambah User</h2>
        <hr>
        <div class="tab-content">
          <div class="tab-pane show active" id="input-types-preview">
              <div class="row ">
                <form action="/tambahData" method="POST">
                  @csrf
                  <div class="col-lg-12">
                          <div class="mb-3">
                              <label for="simpleinput" class="form-label">Username</label>
                              <input type="text" id="simpleinput" name="name" class="form-control">
                          </div>

                          <input type="hidden" name="role" value="Pegawai">

                          <div class="mb-3">
                              <label for="example-email" class="form-label">Email</label>
                              <input type="email" id="example-email" name="email" class="form-control" placeholder="Email">
                          </div>                     
                 
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Pilih Role</label>
                            <select class="form-select" name="golongan_guru" id="example-select">
                              <option selected disabled>Pilih Golongan Guru</option>
                                <option value="Guru PNS">Guru PNS</option>
                                <option value="Guru PPPK">Guru PPPK</option>
                                <option value="Guru Honorer">Guru Honorer</option>
                                <option value="Bukan Guru">Bukan Guru</option>
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="tanggal_penggajian" class="form-label">Tanggal Masuk</label>
                          <input type="date" class="form-control @error('created_at') is-invalid @enderror" id="created_at" 
                          name="created_at"  required autofocus>
                          <span id="created_at" class="alert-message"></span>
                          @error('created_at')
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