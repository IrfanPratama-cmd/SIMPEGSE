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

        <h2>Master Data Guru PNS</h2>
        <div class="col-lg-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Gaji Guru ASN</button>
        </div>
        <hr>
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    {{-- <th>No. </th> --}}
                    <th>Golongan</th>
                    <th>Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>


            <tbody>
                @foreach ($guru as $g)
                <tr class="text-center">
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $g->asn->golongan_asn }}</td>
                    <td>Rp. {{ number_format($g->gaji_asn)}}</td>
                    <td>
                        <a href="/editASN/{{ Crypt::encrypt($g->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAsn/{{  Crypt::encrypt($g->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @foreach ($asn as $a)
                <tr class="text-center">
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $a->golongan_asn }}</td>
                    <td>Rp. 0</td>
                    <td>
                        {{-- <a href="/editAsn/{{ Crypt::encrypt($a->id) }}" class="btn-sm btn-primary">Edit</a>
                        <form action="/deleteAsn/{{  Crypt::encrypt($a->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                        </form> --}} Belum Input
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
                <h4 class="modal-title" id="tambahLabel">Tambah Golongan PNS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahGajiASN" method="post">
                <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Pilih Golongan</label>
                                <div class="input-group">
                                    <select class="form-select" name="asn_id" id="example-select">
                                        <option selected disabled>Pilih Golongan ASN</option>
                                            @foreach ($asn as $a)
                                                <option value="{{ $a->id }}">{{ $a->golongan_asn }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="gaji_asn" class="form-label">Gaji</label>
                                    <input type="text" class="form-control @error('gaji_asn') is-invalid @enderror" id="gaji_asn"
                                    name="gaji_asn"  required autofocus>
                                    <span id="nama-jabatanError" class="alert-message"></span>
                                    @error('gaji_asn')
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
