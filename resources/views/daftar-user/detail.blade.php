@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <h1 class="my-1">Detail User</h1>

          <div class="card">
            <div class="card-header">
              {{-- <h3 class="card-title">Profile User</h3> --}}
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img src="{{ asset('storage/' . $pengguna->foto_profile) }}" class="img-fluid" style="height: 250px; width:220px; display:block; margin-left: auto;
                margin-right: auto;" alt="...">
                    
                <table class="table table-bordered table-hover my-3">
                    <thead>
                     <tr>
                        <th>Nama User</th>
                        <td>{{ $pengguna->name }}</td>
                     </tr>
                    <tr>
                        <th>Nama Intansi</th>
                        <td>{{ $pengguna->instansi->name }}</td>
                     </tr>
                     <tr>
                        <th>Role</th>
                        <td>{{ $pengguna->role }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pengguna->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telp</th>
                        <td>{{ $pengguna->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pengguna->alamat }}</td>
                    </tr>
                    </thead>
                  </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


  <script>

  </script>

@endsection