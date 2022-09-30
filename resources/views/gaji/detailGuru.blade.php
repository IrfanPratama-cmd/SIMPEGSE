@extends('admin.main')

@section('container')

<?php 
  $gaji_pokok =  $guru->mapel->gaji;
  $tunjangan_transport = $tunjangan->tunjangan_transport * $hadir;
  $tunjangan_pasangan = $tunjangan->tunjangan_pasangan * $pasangan;
  $tunjangan_anak = $tunjangan->tunjangan_anak * $anak;
  $total_gaji = $gaji_pokok + $tunjangan_transport + $tunjangan_pasangan + $tunjangan_anak;
?>
        
<div class="row justify-content-center">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="'dasboard'">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="data-diri">Data Gaji Guru</a></li>
                        <li class="breadcrumb-item active">Detail Gaji Guru</li>
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
                            <p><b>Nama      : {{ $guru->pegawai->nama_lengkap }}</b></p>
                            <p><b>NIP       : {{ $guru->pegawai->nip }}</b></p>
                            <p><b>No. NPWP  : {{ $guru->pegawai->no_npwp }}</b></p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-6 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="font-13"><strong>Tanggal Gaji : </strong> &nbsp;&nbsp;&nbsp; {{ $guru->tanggal_penggajian }}</p>
                            <p class="font-13"><strong>Guru Mapel: </strong> <span class="float-end">{{ $guru->mapel->nama_mapel }}</span></p>
                            @if($guru->status == "Dibayar")
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
                                      <tr>
                                        <td width="40%"> Tunjangan Pasangan </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_pasangan) }} </td>
                                      </tr>
                                      {{-- @foreach ($tunjangan as $t)
                                          
                                      @endforeach --}}
                                      <tr>
                                        <td width="40%"> Tunjangan Anak </td>
                                        <td width="25%">:</td>
                                        <td>Rp. {{ number_format($tunjangan_anak) }} </td>
                                      </tr>
                                      <tr>
                                        <td width="40%"> Tunjangan Transport per hari </td>
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

                @if($gaji->status == "Dibayar")
                    <div class="d-print-none mt-4">
                        <div class="text-end">
                            @if(auth()->user()->role == "Admin")
                                <a href="/downloadGajiGuru/{{ Crypt::encrypt($gaji->id) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
                            @elseif(auth()->user()->role == "Pegawai")
                                <a href="/downloadGajiUserGuru/{{ Crypt::encrypt($gaji->id) }}" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print</a>
                            @endif
                        </div>
                    </div>   
                @else
                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <a href="/bayarGajiGuru/{{ Crypt::encrypt($gaji->id) }}" class="btn btn-success"><i class="mdi mdi-cash"></i> Bayar</a>
                    </div>
                </div>   
                @endif
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>

@endsection