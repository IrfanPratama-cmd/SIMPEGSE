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
        <h2>Daftar Divisi</h2>
        {{-- <a href="/tambahDivisi" class="btn btn-success">Tambah Divisi</a> --}}
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah-divisi">Tambah Divisi</button>
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Divisi</th>
                    <th>Admin Divisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($divisi as $d)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_divisi }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td> 
                        <a href="/detailDivisi/{{ Crypt::encrypt($d->id) }}" class="btn-sm btn-primary">Detail</a>
                        <form action="/hapusDivisi/{{  Crypt::encrypt($d->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                        <a href="/editDivisi/{{ Crypt::encrypt($d->id) }}" class="btn-sm btn-info">Edit</a>
                          {{-- <button  type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#fill-danger-modal">Hapus</button> --}}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $divisi->links() }}
    </div>
</div>

<div id="tambah-divisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-divisiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambah-divisiLabel">Tambah Divisi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahDivisi" method="post">
                <div class="modal-body">
                    <div class="card">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nama">Nama Divisi</label>
                                    <input type="text" name="nama_divisi" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Pilih Admin</label>
                                    <select class="form-select" name="user_id" id="example-select">
                                      <option selected disabled>Pilih Admin</option>
                                      @foreach ($admin as $a)
                                        @if(old('user_id') == $a->id)
                                            <option value="{{ $a->id}}" selected>{{ $a->name}}</option>
                                        @else
                                            <option value="{{ $a->id}}">{{ $a->name}}</option>
                                        @endif
                                      @endforeach
                                    </select>
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

<div id="fill-danger-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-header">
                <h4 class="modal-title" id="fill-danger-modalLabel">Danger Filled Modal</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                Apa anda yakin mau menghapus ini?
            </div>
            {{-- <form action="/hapusDivisi/{{  Crypt::encrypt($d->id) }}" method="post">
                @method('delete')
                @csrf --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light">Hapus Data</button>
                </div>
            {{-- </form> --}}
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