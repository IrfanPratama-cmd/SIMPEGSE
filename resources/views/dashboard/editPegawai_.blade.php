@extends('admin.ajax')

{{-- @section('container') --}}

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>Laravel 8: Dynamic Dependent Dropdown</title>
    </head>
    <body>
        <section class="content ">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-2">

                </div>
                <div class="col-8">
                  <br> <br> <br> <br>
                  <a href="/daftar-pegawai" class="btn btn-primary">Kembali</a>
                  <div class="card mt-2">
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form action="/updateDivisiPegawai/{{ Crypt::encrypt($pegawai->id) }}" method="post" class="mb-5" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <h2 class="my-1">Edit Pegawai</h2>
                        <input type="hidden" value="{{ $pegawai->nama_pegawai }}">
                        <table class="table">
                            <tbody>
                              <tr>
                                <td width="30%"><h4> Nama Pegawai </h4></td>
                                <td width="5%"><h4>:</h4></td>
                                <td><h4> {{ $pegawai->nama_lengkap }} </h4></td>
                              </tr>
                            </tbody>
                        </table>
        
                        <div class="mb-3">
                            <label for="divisi" class="form-label">Divisi</label>
                            <select class="form-select" name="divisi_id" id="divisi">
                              @foreach ($divisi as $d)
                                @if(old('divisi_id') == $d->id)
                                    <option value="{{ $d->id}}" selected>{{ $d->nama_divisi}}</option>
                                @else
                                    <option value="{{ $d->id}}">{{ $d->nama_divisi}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
        
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-control" name="jabatan_id" id="jabatan"></select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  {{-- @endforeach   --}}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>

  <!-- /.content -->
  
<script src="/hyper/assets/js/vendor.min.js"></script>
<script src="/hyper/assets/js/app.min.js"></script>
<script>
  $(document).ready(function() {
          $('#divisi').on('change', function() {
             var divisiID = $(this).val();
             if(divisiID) {
                 $.ajax({
                     url: '/getJabatan/'+divisiID,
                     type: "GET",
                     data : {"_token":"{{ csrf_token() }}"},
                     dataType: "json",
                     success:function(data)
                     {
                       if(data){
                          $('#jabatan').empty();
                          $('#jabatan').append('<option hidden>Pilih Jabatan</option>'); 
                          $.each(data, function(id, jabatan){
                              $('select[name="jabatan_id"]').append('<option value="'+ jabatan.id +'">' + jabatan.nama_jabatan+ '</option>');
                          });
                      }else{
                          $('#jabatan').empty();
                      }
                   }
                 });
             }else{
               $('#jabatan').empty();
             }
          });
          });
</script>
    </body>
</html>


{{-- @endsection --}}