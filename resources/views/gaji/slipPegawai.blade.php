@extends('admin.main')

@section('container')

<?php 
   $gaji_pokok =  $gaji->gaji_pokok;
  $tunjagan_pangan = $tunjangan->tunjagan_pangan * $hadir;
  $tunjangan_pasangan = $tunjangan->tunjangan_pasangan * $pasangan;
  $tunjangan_anak = $tunjangan->tunjangan_anak * $anak;
  $total_gaji = $gaji_pokok + $tunjagan_pangan + $tunjangan_pasangan + $tunjangan_anak;
?>

<div class="row justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="'dasboard'">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="data-diri">Data Gaji</a></li>
                        <li class="breadcrumb-item active">Detail Gaji</li>
                    </ol>
                </div>
                {{-- <h1 class="my-1">Detail Gaji {{ $gaji->pegawai->nama_lengkap }}</h1> --}}
            </div>
        </div>
    </div> 
    
    {{-- <h1>Hadir {{ $hadir }}</h1>
    <h1>Absensi {{ $absensi }}</h1>
    <h1>Alpha {{ $alpha }}</h1> --}}
    
    <div class="col-8">
        <div class="card">
            

            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="/landing/assets/img/simanwai.png" alt="" height="38">
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
                            <p class="font-13"><strong>Jabatan: </strong> <span class="float-end">{{ $nama_jabatan }}</span></p>
                            @if($gaji->status == "Dibayar")
                                <p class="font-13"><strong>Status : </strong> <span class="badge bg-success float-end">Dibayar</span></p>
                            @else
                                <p class="font-13"><strong>Status : </strong> <span class="badge bg-warning float-end">Belum Dibayar</span></p>
                            @endif
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <h4>Total kehadiran : {{ $hadir }}</h4>
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
                                      {{-- <tr>
                                        <td width="40%"> Tunjangan Jabatan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_jabatan) }} </td>
                                      </tr> --}}
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
                                      {{-- <tr>
                                        <td width="40%"> Tunjangan Makan per hari </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_makan) }} </td>
                                      </tr> --}}
                                      <tr>
                                        <td width="40%"> Tunjangan Pangan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjagan_pangan) }} </td>
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

                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <a href="/downloadGajiUserPegawai/{{ Crypt::encrypt($gaji->id) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
                    </div>
                </div>   
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>

@endsection