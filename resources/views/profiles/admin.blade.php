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
          <h1 class="my-1">Profile Instansi</h1>

          @foreach ($instansi as $i)

          <div class="card">
            <div class="card-header">
              {{-- <h3 class="card-title">Profile User</h3> --}}
              <a href="/editAdmin/{{ Crypt::encrypt($i->id) }}" class="btn btn-primary">Edit Profile</a>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img src="{{ asset('storage/' . $i->foto_instansi) }}" class="img-fluid" style="height: 250px; width:220px; display:block; margin-left: auto;
                margin-right: auto;" alt="...">
                    
                <table class="table table-bordered table-hover my-3">
                    <thead>
                    <tr>
                        <th>Nama Intansi</th>
                        <td>{{ $i->name }}</td>
                     </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $i->user->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telp</th>
                        <td>{{ $i->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $i->alamat }}</td>
                    </tr>
                    </thead>
                  </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          @endforeach  
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