@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="content">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="'dasboard'">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="data-diri">Data Diri</a></li>
                        <li class="breadcrumb-item active">Profile Siswa</li>
                    </ol>
                </div>
                <h2>Profile</h2>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @foreach($siswa as $s)

    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Informasi Utama</h3>
                            <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                                <a href="/editProfileSiswa/{{ Crypt::encrypt($s->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar">
                                        <img src="{{ url('profile-siswa/' . $s->foto_profile) }}" alt="" width="200px" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <p class="text-muted"><strong>Nama Lengkap :</strong> <span class="ms-2">{{ $s->nama_siswa }}</span></p>

                                        <p class="text-muted"><strong>Email :</strong> <span class="ms-2">{{ $s->user->email }}</span></p>

                                        <p class="text-muted"><strong>NIS</strong> <span class="ms-2">{{ $s->nis }}</span></p>

                                        <p class="text-muted"><strong>Nomor Telpon:</strong> <span class="ms-2">{{ $s->no_telp }}</span></p>
                            
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        {{-- <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <a href="" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                            </div>
                        </div> <!-- end col--> --}}
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-12">
            <!-- Personal-Information -->
            <div class="card">
                <div class="card-body">
                    <h3 >Data Pendukung</h3>
                   
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $s->tgl_lahir }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Agama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $s->agama }}" readonly>
    
                        </div>
                    </div>
                    
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $s->jk }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $s->alamat }}" readonly>
    
                        </div>
                    </div>
                </div>
            </div>
            <!-- Personal-Information -->

        </div>
        <!-- end col -->

    </div>
    <!-- end row -->
    
    @endforeach

</div>


  <script>

  </script>

@endsection