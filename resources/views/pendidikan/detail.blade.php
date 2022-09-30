@extends('admin.main')

@section('container')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="data-diri">Data Diri</a></li>
                    <li class="breadcrumb-item active">Data Pendidikan</li>
                </ol>
            </div>
            <h2>Data Pendidikan</h2>
        </div>
    </div>
</div>   

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
         
            <div class="card">
                <div class="card-body">
                    <h3 >Detail Pendidikan</h3>
                    <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                        <a href="/editPendidikan/{{ Crypt::encrypt($pendidikan->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Data</a>
                    </div>
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jenjang Pendidikan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $pendidikan->jenjang_pendidikan }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nama Instansi / Sekolah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $pendidikan->nama_instansi }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Program Studi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $pendidikan->prodi}}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tahun Masuk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $pendidikan->tahun_masuk }}" readonly>
    
                        </div>
                    </div>

                    <br>
        
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tahun Lulus</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $pendidikan->tahun_lulus }}" readonly>
    
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