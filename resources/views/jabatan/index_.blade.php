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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

</head>
<style>
.alert-message {
  color: red;
}
</style>
<body>

<div class="card">
    <div class="card-body">
        <h2>Data Jabatan</h2>
        {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tambah-jabatan">Tambah Jabatan</button> --}}
        <a href="javascript:void(0)" class="btn btn-info mb-3" id="tambah-jabatan" onclick="addJabatan()">Tambah Jabatan</a>  
        <table  class="table table-striped dt-responsive nowrap w-100 mt-2 px-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th width="18%">Nama Jabatan</th>
                    <th width="15%">Gaji Pokok</th>
                    <th width="20%">Tunjangan Jabatan</th>
                    <th width="18%">Tunjangan Makan</th>
                    <th width="20%">Tunjangan Transport</th>
                    <th>Hapus</th>
                    <th>Edit</th>
                </tr>
            </thead>
        
        
            <tbody>
                @foreach ($jabatan as $j)
                <tr class="text-center">
                    <td>{{ $j->nama_jabatan }}</td>
                    <td>Rp. {{ number_format($j->gaji_pokok)  }}</td>
                    <td>Rp. {{ number_format($j->tunjangan_jabatan)  }}</td>
                    <td>Rp. {{ number_format($j->tunjangan_makan_perhari) }}</td>
                    <td>Rp. {{ number_format($j->tunjangan_transport_perhari) }}</td>
                    <td> 
                        <form action="/hapusJabatan/{{  Crypt::encrypt($j->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn-sm btn-danger border-0"  onclick="return confirm('Are you sure?')">Hapus
                              </button>
                          </form>
                           {{-- <a href="javascript:void(0)" data-id="{{ $j->id }}" class="btn btn-danger d-inline" onclick="hapusJabatan(event.target)">Delete</a> --}}
                    
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-id="{{ $j->id }}" onclick="editJabatan(event.target)" class="btn-sm btn-info">Edit</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>


<div id="jabatan-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-jabatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambah-jabatanLabel">Tambah Jabatan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahJabatan" method="post" >
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" 
                        name="nama_jabatan"  required autofocus>
                        <span id="nama-jabatanError" class="alert-message"></span>
                        @error('nama_jabatan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" 
                        name="gaji_pokok"  required autofocus>
                        <span id="gaji-pokokError" class="alert-message"></span>
                        @error('gaji_pokok')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>  
                    <div class="mb-3">
                        <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                        <input type="number" class="form-control @error('tunjangan_jabatan') is-invalid @enderror" id="tunjangan_jabatan" 
                        name="tunjangan_jabatan"  required autofocus>
                        <span id="tunjangan-jabatanError" class="alert-message"></span>
                        @error('tunjangan_jabatan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>        
                    <div class="mb-3">
                        <label for="tunjangan_makan_perhari" class="form-label">Tunjangan Makan per Hari</label>
                        <input type="number" class="form-control @error('tunjangan_makan_perhari') is-invalid @enderror" id="tunjangan_makan_perhari" 
                        name="tunjangan_makan_perhari"  required autofocus>
                        <span id="tunjangan-makan-perhariError" class="alert-message"></span>
                        @error('tunjangan_makan_perhari')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="tunjangan_transport_perhari" class="form-label">Tunjangan Transport per Hari</label>
                        <input type="number" class="form-control @error('tunjangan_transport_perhari') is-invalid @enderror" id="tunjangan_transport_perhari" 
                        name="tunjangan_transport_perhari"  required autofocus>
                        <span id="tunjangan-transport-perhariError" class="alert-message"></span>
                        @error('tunjangan_transport_perhari')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="tambahJabatan()">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="jabatan-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-jabatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tambah-jabatanLabel">Tambah Jabatan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="/tambahJabatan" method="post" >
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" 
                        name="nama_jabatan"  required autofocus>
                        <span id="nama-jabatanError" class="alert-message"></span>
                        @error('nama_jabatan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" 
                        name="gaji_pokok"  required autofocus>
                        <span id="gaji-pokokError" class="alert-message"></span>
                        @error('gaji_pokok')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>  
                    <div class="mb-3">
                        <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                        <input type="number" class="form-control @error('tunjangan_jabatan') is-invalid @enderror" id="tunjangan_jabatan" 
                        name="tunjangan_jabatan"  required autofocus>
                        <span id="tunjangan-jabatanError" class="alert-message"></span>
                        @error('tunjangan_jabatan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>        
                    <div class="mb-3">
                        <label for="tunjangan_makan_perhari" class="form-label">Tunjangan Makan per Hari</label>
                        <input type="number" class="form-control @error('tunjangan_makan_perhari') is-invalid @enderror" id="tunjangan_makan_perhari" 
                        name="tunjangan_makan_perhari"  required autofocus>
                        <span id="tunjangan-makan-perhariError" class="alert-message"></span>
                        @error('tunjangan_makan_perhari')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="tunjangan_transport_perhari" class="form-label">Tunjangan Transport per Hari</label>
                        <input type="number" class="form-control @error('tunjangan_transport_perhari') is-invalid @enderror" id="tunjangan_transport_perhari" 
                        name="tunjangan_transport_perhari"  required autofocus>
                        <span id="tunjangan-transport-perhariError" class="alert-message"></span>
                        @error('tunjangan_transport_perhari')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>    
                        @enderror
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="tambahJabatan()">Simpan</button>
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

<script>

$('#laravel_crud').DataTable();

function addJabatan() {
  $("#id").val('');
  $('#jabatan-modal').modal('show');
}

function editJabatan(event) {
  var id  = $(event).data("id");
  let _url = `/jabatan/${id}`;
  $('#nama-jabatanError').text('');
  $('#gaji-pokokError').text('');
  $('#tunjangan-jabatanError').text('');
  $('#tunjangan-makan-perhariError').text('');
  $('#tunjangan-transport-perhariError').text('');
  
  $.ajax({
    url: _url,
    type: "GET",
    success: function(response) {
        if(response) {
          $("#id").val(response.id);
          $("#nama_jabatan").val(response.nama_jabatan);
          $("#gaji_pokok").val(response.gaji_pokok);
          $("#tunjangan_jabatan").val(response.tunjangan_jabatan);
          $("#tunjangan_makan_perhari").val(response.tunjangan_makan_perhari);
          $("#tunjangan_transport_perhari").val(response.tunjangan_transport_perhari);
          $('#jabatan-modal').modal('show');
        }
    }
  });
}

function tambahJabatan() {
  var nama_jabatan = $('#nama_jabatan').val();
  var gaji_pokok = $('#gaji_pokok').val();
  var tunjangan_jabatan = $('#tunjangan_jabatan').val();
  var tunjangan_makan_perhari = $('#tunjangan_makan_perhari').val();
  var tunjangan_transport_perhari = $('#tunjangan_transport_perhari').val();
  var id = $('#id').val();

  let _url     = `/jabatan`;
  let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: _url,
      type: "POST",
      data: {
        id: id,
        nama_jabatan: nama_jabatan,
        gaji_pokok: gaji_pokok,
        tunjangan_jabatan: tunjangan_jabatan,
        tunjangan_makan_perhari: tunjangan_makan_perhari,
        tunjangan_transport_perhari: tunjangan_transport_perhari,
        _token: _token
      },
      success: function(response) {
          if(response.code == 200) {
            if(id != ""){
              $("#row_"+id+" td:nth-child(2)").html(response.data.nama_jabatan);
              $("#row_"+id+" td:nth-child(3)").html(response.data.gaji_pokok);
              $("#row_"+id+" td:nth-child(4)").html(response.data.tunjangan_jabatan);
              $("#row_"+id+" td:nth-child(5)").html(response.data.tunjangan_makan_perhari);
              $("#row_"+id+" td:nth-child(6)").html(response.data.tunjangan_transport_perhari);
            } else {
              $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.nama_jabatan+'</td><td>'+response.data.gaji_pokok+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editJabatan(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="hapusJabatan(event.target)">Hapus</a></td></tr>');
            }
            $('#nama_jabatan').val('');
            $('#gaji_pokok').val('');
            $('#tunjangan_jabatan').val('');
            $('#tunjangan_makan_perhari').val('');
            $('#tunjangan_transport_perhari').val('');

            $('#jabatan-modal').modal('hide');
          }
      },
      error: function(response) {
        $('#nama_jabatanError').text(response.responseJSON.errors.nama_jabatan);
        $('#gaji_pokokError').text(response.responseJSON.errors.gaji_pokok);
        $('#tunjangan_jabatanError').text(response.responseJSON.errors.tunjangan_jabatan);
        $('#tunjangan_makan_perhariError').text(response.responseJSON.errors.tunjangan_makan_perhari);
        $('#tunjangan_transport_perhariError').text(response.responseJSON.errors.tunjangan_transport_perhari);
      }
    });
}

function hapusJabatan(event) {
  var id  = $(event).data("id");
  let _url = `/jabatan/${id}`;
  let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: _url,
      type: 'DELETE',
      data: {
        _token: _token
      },
      success: function(response) {
        $("#row_"+id).remove();
      }
    });
}


</script>


@endsection