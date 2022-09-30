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
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h2>Profile</h2>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @foreach($pegawai as $p)

    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Informasi Utama</h3>
                            @foreach($id as $i)
                            <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                                <a href="/infoUtama/{{ Crypt::encrypt($i) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                            </div>
                            <hr>
                            @endforeach
                            <div class="row align-items-center">
                                @foreach($foto as $f)
                                <div class="col-auto">
                                    <div class="avatar">
                                        {{-- <img src="{{ asset('storage/' . $f) }}" alt="" width="200px" class="rounded-circle img-thumbnail"> --}}
                                        <img src="{{ url('foto-profile/' . $f) }}" alt="" width="200px" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                @endforeach
                                <div class="col">
                                    <div>
                                        <p class="text-muted"><strong>Nama Lengkap :</strong> <span class="ms-2">{{ $p->nama_lengkap }}</span></p>

                                        <p class="text-muted"><strong>Email :</strong> <span class="ms-2">{{ $p->email }}</span></p>

                                        <p class="text-muted"><strong>NIP:</strong> <span class="ms-2">{{ $p->nip }}</span></p>

                                        <p class="text-muted"><strong>Nomor Telpon:</strong> <span class="ms-2">{{ $p->no_telp }}</span></p>

                                        <p class="text-muted"><strong>Golongan Guru:</strong> <span class="ms-2">{{ $p->golongan_guru }}</span></p>

                                        @if($p->golongan_guru == "Guru PNS")

                                            <p class="text-muted"><strong>Golongan PNS:</strong> <span class="ms-2">{{ $p->golongan_asn }}</span></p>

                                        @elseif($p->golongan_guru == "Guru PPPK")

                                            <p class="text-muted"><strong>PPPK:</strong> <span class="ms-2">{{ $p->golongan_pppk }}</span></p>

                                        @endif

                                        <p class="text-muted"><strong>Jabatan:</strong> <span class="ms-2">{{ $p->nama_jabatan }}</span></p>

                                        @foreach($masuk as $m)
                                        <?php 
                                            $diff = date_diff( $m, $tanggal );
                                        ?>
                                        <p class="text-muted"><strong>Tanggal Masuk:</strong> <span class="ms-2">{{ $m->format('Y-m-d') }}</span></p>
                                        <p class="text-muted"><strong>Masa Kerja:</strong> <span class="ms-2">{{ $diff->y }} Tahun {{ $diff->m }} Bulan</span></p>
                                        @endforeach
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
                    @foreach($id as $i)
                    <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                        <a href="/dataPendukung/{{ Crypt::encrypt($i) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Data</a>
                    </div>
                    @endforeach
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">NIK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->nik }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nomor KK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->no_kk }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Agama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->agama }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->tgl_lahir }}" readonly>
    
                        </div>
                    </div>


                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">No NPWP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->no_npwp }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">No BPJS</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->no_bpjs }}" readonly>
    
                        </div>
                    </div>

                    <br>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">No Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->no_rekening }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->jk }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="{{ $p->alamat }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    @foreach ($ktp as $k)
                        <div class="form-group row pl-4 pr-4">
                            <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Foto KTP</label>
                            <div class="col-sm-10">
                                <img src="{{  url('foto-ktp/' . $k) }}" alt="" width="320px" class="img-thumbnail">
                            </div>
                        </div>
                    @endforeach
                   
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