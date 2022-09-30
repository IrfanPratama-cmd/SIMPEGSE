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

<div class="container">
     <div class="row">
       <div class="col-12 text-right">
         <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="addPost()">Add Post</a>
       </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
          <table id="laravel_crud" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Jabatan</th>
                    <th>Tunjangan Makan</th>
                    <th>Tunjangan Transport</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jabatan as $j)
                <tr id="row_{{$j->id}}">
                   <td>{{ $j->id  }}</td>
                   <td>{{ $j->nama_jabatan }}</td>
                   <td>{{ $j->gaji_pokok }}</td>
                   <td>{{ $j->tunjangan_jabatan }}</td>
                   <td>{{ $j->tunjangan_makan_perhari }}</td>
                   <td>{{ $j->tunjangan_transport_perhari }}</td>
                   <td><a href="javascript:void(0)" data-id="{{ $j->id }}" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td>
                   <td>
                    <a href="javascript:void(0)" data-id="{{ $j->id }}" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
       </div>
    </div>
</div>
</body>

<div class="modal fade" id="post-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
              <form name="userForm" class="form-horizontal">
                 <input type="hidden" name="id" id="id">
                  <div class="form-group">
                      <label for="name" class="col-sm-2">Nama Jabatan</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan">
                          <span id="nama_jabatanError" class="alert-message"></span>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="name" class="col-sm-2">Gaji Pokok</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Nama Jabatan">
                        <span id="gaji_pokokError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2">Tunjangan Jabatan</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan" placeholder="Nama Jabatan">
                        <span id="tunjangan_jabatanError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2">Tunjangan Makan per Hari</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="tunjangan_makan_perhari" name="tunjangan_makan_perhari" placeholder="Nama Jabatan">
                        <span id="tunjangan_makan_perhariError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2">Tunjangan Transport per Hari</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="tunjangan_transport_perhari" name="tunjangan_transport_perhari" placeholder="Nama Jabatan">
                        <span id="tunjangan_transport_perhariError" class="alert-message"></span>
                    </div>
                </div>
  
                 
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
          </div>
      </div>
    </div>
  </div>

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>

<script>

$('#laravel_crud').DataTable();

  function addPost() {
    $("#id").val('');
    $('#post-modal').modal('show');
  }

  function editPost(event) {
    var id  = $(event).data("id");
    let _url = `/jabatan/${id}`;
    $('#nama_jabatanError').text('');
  $('#gaji_pokokError').text('');
  $('#tunjangan_jabatanError').text('');
  $('#tunjangan_makan_perhariError').text('');
  $('#tunjangan_transport_perhariError').text('');
    
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
            $('#post-modal').modal('show');
          }
      }
    });
  }

  function createPost() {
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

              $('#post-modal').modal('hide');
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

  function deletePost(event) {
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