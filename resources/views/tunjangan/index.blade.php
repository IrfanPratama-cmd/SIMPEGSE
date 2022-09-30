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
                        <li class="breadcrumb-item active">Tunjangan</li>
                    </ol>
                </div>
                <h2>Setting</h2>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @foreach($tunjangan as $t)

    <div class="row">
        <div class="col-xl-12">
            <!-- Personal-Information -->
            <div class="card">
                <div class="card-body">
                    <h3 >Tunjangan Pegawai</h3>
                    <div class="text-center mt-sm-0 mt-3 text-sm-end d-inline">
                        <a href="/editTunjangan/{{ Crypt::encrypt($t->id) }}" class="btn btn-info"><i class="mdi mdi-account-edit me-1"></i> Edit Tunjangan</a>
                    </div>
                    <hr>

                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tunjangan Pasangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="Rp. {{ number_format($t->tunjangan_pasangan) }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tunjangan Anak</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="Rp. {{  number_format($t->tunjangan_anak) }}" readonly>
    
                        </div>
                    </div>
                    <br>
                    <div class="form-group row pl-4 pr-4">
                        <label for="namaProduk" class="col-sm-2 tmbhprod-subtitle">Tunjangan Pangan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-form" value="Rp. {{ number_format($t->tunjangan_pangan) }}" readonly>
    
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