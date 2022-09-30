@extends('admin.main')

@section('container')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="data-diri">Data Diri</a></li>
                    <li class="breadcrumb-item active">Riwayat Organisasi</li>
                </ol>
            </div>
            <h2>Riwayat Organisasi</h2>
        </div>
    </div>
</div>   

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
         
            <div class="card">
                <div class="card-body">
                    <h3 >Detail Riwayat Organisasi</h3>
                    <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                        <a href="/editOrganisasi/{{ Crypt::encrypt($organisasi->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Data</a>
                    </div>
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nama Organisasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $organisasi->nama_organisasi }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Bidang Organisasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $organisasi->bidang_organisasi }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $organisasi->jabatan}}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Periode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $organisasi->periode }}" readonly>
    
                        </div>
                    </div>

                    <br>
        
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Bukti Organisasi</label>
                        <div class="col-sm-10">
                            <img src="{{ url('bukti-organisasi/' . $organisasi->bukti_organisasi) }}" alt="" width="320px" class="img-thumbnail">
    
                        </div>
                    </div>

                    <br>
                    
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>


  <script>

  </script>

@endsection