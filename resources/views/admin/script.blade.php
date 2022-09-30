<!-- bundle -->
<script src="/hyper/assets/js/vendor.min.js"></script>
<script src="/hyper/assets/js/app.min.js"></script>

<!-- third party js -->
<script src="/hyper/assets/js/vendor/apexcharts.min.js"></script>
<script src="/hyper/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/hyper/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="/hyper/assets/js/pages/demo.dashboard.js"></script>
<!-- end demo js-->

<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="/hyper/assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="/hyper/assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="/hyper/assets/js/vendor/responsive.bootstrap5.min.js"></script>

<!-- Datatable Init js -->
<script src="/hyper/assets/js/pages/demo.datatable-init.js"></script>
<script src="/hyper/assets/js/vendor/dataTables.select.min.js"></script>

<script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

<!-- plugin js -->
<script src="/hyper/assets/js/vendor/dropzone.min.js"></script>
<!-- init js -->
<script src="/hyper/assets/js/ui/component.fileupload.js"></script>


<script src="/hyper/assets/js/jquery/jquery.min.js"></script>
      <script src="/hyper/assets/js/toastr/toastr.min.js"></script>
  <script>

    $(document).ready(function(){
      $('#jenjang_pendidikan').change(function(){
          var kel = $('#jenjang_pendidikan option:selected').val();
          if (kel == "D-3") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          } else if(kel == "S-1") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }else if(kel == "S-2") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }else if(kel == "S-3") {
            $("#addProdi").addClass("mb-3");
            $("#addProdi").html(`
              <input id="prodi" type="text"  placeholder="Program Studi" class="form-control @error('prodi') 
              is-invalid @enderror" name="prodi" autocomplete="prodi">
              `);
            $("#pesan").html(`
              @error('prodi')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
          }
          } else {
            $('#addProdi').removeClass("mb-3");
            $('#addProdi').html('');
          }
      });
  });
//   function inputAngka(e) {
//     var charCode = (e.which) ? e.which : event.keyCode
//     if (charCode > 31 && (charCode < 48 || charCode > 57)){
//       return false;
//     }
//     return true;
//   }
  </script>


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