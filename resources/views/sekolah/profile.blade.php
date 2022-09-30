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
                        {{-- <li class="breadcrumb-item"><a href="data-diri">Data Diri</a></li> --}}
                        <li class="breadcrumb-item active">Profile Sekolah</li>
                    </ol>
                </div>
                <h2>Profile</h2>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @foreach($sekolah as $s)

    {{-- <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Informasi Utama</h3>
                            <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                                <a href="/infoUtama/{{ Crypt::encrypt($p->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar">
                                        <img src="{{ asset('storage/' . $p->foto_profile) }}" alt="" width="200px" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <p class="text-muted"><strong>Nama Lengkap :</strong> <span class="ms-2">{{ $p->nama_lengkap }}</span></p>

                                        <p class="text-muted"><strong>Email :</strong> <span class="ms-2">{{ $p->user->email }}</span></p>

                                        <p class="text-muted"><strong>NIP:</strong> <span class="ms-2">{{ $p->nip }}</span></p>

                                        <p class="text-muted"><strong>Nomor Telpon:</strong> <span class="ms-2">{{ $p->no_telp }}</span></p>
                            
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
        
        <!-- Personal-Information -->
        <div class="card">
            <div class="card-body">
            <h3>Profile Sekolah</h3>
                <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                    <a href="/editProfileSekolah/{{ Crypt::encrypt($s->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="avatar">
                            @if($s->foto_sekolah == null)
                                <img src="/landing/assets/img/student.png" alt="" width="200px" class="rounded-circle img-thumbnail">
                            @else
                                <img src="{{ asset('storage/' . $s->foto_sekolah) }}" alt="" width="200px" class="rounded-circle img-thumbnail">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="form-group row pl-4 pr-4">
                            <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nama Sekolah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-form" value="{{ $s->nama_sekolah }}" readonly>
        
                            </div>
                        </div>
                        <br>
                        <div class="form-group row pl-4 pr-4">
                            <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-form" value="{{ $s->user->email }}" readonly>
        
                            </div>
                        </div>
    
                        <br>
                        <div class="form-group row pl-4 pr-4">
                            <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-form" value="{{ $s->no_telp }}" readonly>
        
                            </div>
                        </div>
    
                        <br>
                        <div class="form-group row pl-4 pr-4">
                            <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-form" value="{{ $s->alamat }}" readonly>
        
                            </div>
                        </div>
                        <br><br><br>
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