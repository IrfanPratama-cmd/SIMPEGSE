<?php 
  $gaji_pokok =  $gaji->jabatan->gaji_pokok;
  $tunjangan_jabatan =  $gaji->jabatan->tunjangan_jabatan;
  $tunjangan_makan = $gaji->jabatan->tunjangan_makan_perhari * $hadir;
  $tunjangan_transport = $gaji->jabatan->tunjangan_transport_perhari * $hadir;
  $tunjangan_pasangan = $gaji->jabatan->tunjangan_pasangan * $pasangan;
  $tunjangan_anak = $gaji->jabatan->tunjangan_anak * $anak;
  $total_gaji = $gaji_pokok + $tunjangan_jabatan + $tunjangan_makan + $tunjangan_transport + $tunjangan_pasangan + $tunjangan_anak;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Slip Gaji</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="/hyper/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/hyper/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="/hyper/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>


    <body>
    
    <div class="row justify-content-center mt-3">
    <div class="col-8">
        <div class="card">
            

            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="/hyper/assets/images/logo-light.png" alt="" height="18">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Slip Gaji</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mt-3">
                            <p><b>Nama      : {{ $gaji->pegawai->nama_lengkap }}</b></p>
                            <p><b>NIP       : {{ $gaji->pegawai->nip }}</b></p>
                            <p><b>No. NPWP  : {{ $gaji->pegawai->no_npwp }}</b></p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-6 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="font-13"><strong>Tanggal Gaji : </strong> &nbsp;&nbsp;&nbsp; {{ $gaji->tanggal_penggajian }}</p>
                            <p class="font-13"><strong>Divisi: </strong> <span class="float-end">{{ $gaji->divisi->nama_divisi }}</span></p>
                            <p class="font-13"><strong>Jabatan: </strong> <span class="float-end">{{ $gaji->jabatan->nama_jabatan }}</span></p>
                            <p class="font-13"><strong>Status : </strong> <span class="badge bg-success float-end">Paid</span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>:</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="40%"> Gaji Pokok </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($gaji_pokok) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Jabatan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_jabatan) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Pasangan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_pasangan) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Anak </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_anak) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Makan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_makan) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Transport </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_transport) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> <h4>Total Gaji</h4> </td>
                                        <td width="25%"><h4>:</h4></td>
                                        <td> <h4>Rp. {{ number_format($total_gaji) }}</h4> </td>
                                      </tr>

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
        </div>


         <!-- bundle -->
         <script src="/hyper/assets/js/vendor.min.js"></script>
         <script src="/hyper/assets/js/app.min.js"></script>
    </body>
    </html>

