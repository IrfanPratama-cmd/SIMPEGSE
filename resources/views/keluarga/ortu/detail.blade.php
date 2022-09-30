@extends('admin.main')

@section('container')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Diri</a></li>
                    <li class="breadcrumb-item active">Data Keluarga</li>
                </ol>
            </div>
            <h2>Data Keluarga</h2>
        </div>
    </div>
</div>   

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
         
            <div class="card">
                <div class="card-body">
                    <h3 >Data Orang Tua</h3>
                    <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                        <a href="/editOrtu/{{ Crypt::encrypt($ortu->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Data</a>
                    </div>
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nama Orang Tua</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->nama_ortu }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->nik }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->agama }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->tgl_lahir }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->jk }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $ortu->status }}" readonly>
    
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