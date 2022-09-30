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
                    <h3 >Data Anak</h3>
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Nama Anak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->nama_anak }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->nik }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Anak Ke</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->anak_nmr}}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->jk }}" readonly>
    
                        </div>
                    </div>

                    <br>
        
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->agama }}" readonly>
    
                        </div>
                    </div>

                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->tgl_lahir }}" readonly>
    
                        </div>
                    </div>

                    <br>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">No. Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->no_telp }}" readonly>
    
                        </div>
                    </div>

                    <br>

                    
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-form" value="{{ $anak->status }}" readonly>
    
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