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
        <h2>Daftar User {{ $nama_sekolah }}</h2>
        {{-- <a href="/tambahUser" class="btn btn-success">Tambah User</a> --}}
        <hr>
        <div class="app-search dropdown d-none d-lg-block col-4">
            <form action="/cariUser" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="cariUser" value="{{ old('cariUser') }}"  placeholder="Search User" id="top-search">
                    <span class="mdi mdi-magnify search-icon"></span>
                    <button class="input-group-text btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Verifikasi Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($users as $user)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->role }}</td>
                    @if ($user->is_email_verified == 0)
                        <td>Belum diverifikasi</td>
                    @elseif ($user->is_email_verified == 1)
                        <td>Sudah diverifikasi</td>
                    @endif
                    <td> 
                        @if($user->is_email_verified == 0)
                            <form action="/verifUser/{{ $user->id }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="is_email_verified" value="1">
                                <button class="btn btn-primary">Verifikasi</button>
                           </form>
                        @elseif ($user->is_email_verified == 1)
                            <form action="/hapusVerif/{{ $user->id }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                <input type="hidden" name="is_email_verified" value="0">
                                <button class="btn btn-danger"  onclick="return confirm('Apa anda mau menghapus verifikasi?')">Hapus</button>
                            </form>
                       @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection