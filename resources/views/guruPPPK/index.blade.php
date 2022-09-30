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
           
        <h2>Master Data Guru PPPK</h2>
        <div class="col-lg-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Golongan PPPK</button>
        </div>   
        <hr>    
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No. </th>
                    <th>Golongan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($pppk as $p)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->golongan_pppk }}</td>
                    <td>
                        <a href="/editAsn/{{ Crypt::encrypt($p->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAsn/{{  Crypt::encrypt($p->id) }}" method="post" class="d-inline">
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
        {{-- {{ $angkatan->links() }} --}}
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambahLabel">Tambah Golongan PPPK</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahMasterPppk" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="golongan_pppk" class="form-label">Golongan PPPK</label>
                                    <input type="text" class="form-control @error('golongan_pppk') is-invalid @enderror" id="golongan_pppk" 
                                    name="golongan_pppk"  required autofocus>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('golongan_pppk')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>    
                                    @enderror
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