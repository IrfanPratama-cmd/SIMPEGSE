@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="card">
    <div class="card-body">
        <h2>Daftar Admin Divisi</h2>
        {{-- <a href="/tambahAdmin" class="btn btn-success">Tambah Admin</a> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-admin">Tambah Admin</button>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Verifikasi Email</th>
                    {{-- <th>Divisi</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($admin as $a)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->email }}</td>
                    <td>{{ $a->email_verified_at }}</td>
                    {{-- <td>{{ $a->divisi->nama_divisi }}</td> --}}
                    <td> 
                        <a href="/detailAdmin/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-primary">Detail</a>
                        <form action="/deleteAdmin/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

<div id="tambah-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-adminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambah-adminLabel">Tambah Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/simpanAdmin" method="post">
                <div class="modal-body">
                    <div class="card">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="nama">Username</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="nama">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div> 
                            </div>       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection