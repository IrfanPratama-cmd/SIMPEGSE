<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>

    <style>
        .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 18cm;  
  height: 22.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>

<?php 
  $gaji_pokok =  $guru->mapel->gaji;
  $tunjangan_transport = $tunjangan->tunjangan_transport * $hadir;
  $tunjangan_pasangan = $tunjangan->tunjangan_pasangan * $pasangan;
  $tunjangan_anak = $tunjangan->tunjangan_anak * $anak;
  $total_gaji = $gaji_pokok + $tunjangan_transport + $tunjangan_pasangan + $tunjangan_anak;
?>

  </head>
  <body>
    <header class="clearfix">
      <h1>Slip Gaji</h1>
      <div id="company" class="clearfix">
        {{-- <div>Divisi : {{ $gaji->divisi->nama_divisi }}</div> --}}
        <div>Guru Mapel : {{ $guru->mapel->nama_mapel }}</div>
        {{-- <div><a href="mailto:company@example.com">{{ $gaji->pegawai->user->email }}</a></div> --}}
      </div>
      <div id="project">
        <div><span>NAMA</span> {{ $gaji->pegawai->nama_lengkap }}</div>
        <div><span>NIP</span> {{ $gaji->pegawai->nip }}</div>
        <div><span>NPWP</span> {{ $gaji->pegawai->no_npwp }}</div>
        <div><span>TANGGAL  </span> {{ $gaji->tanggal_penggajian }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>KETERANGAN</th>
            <th>:</th>
            <th >JUMLAH</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td width="40%" class="service">Gaji Pokok</td>
            <td width="25%" class="desc">:</td>
            <td  class="unit">Rp. {{ number_format($gaji_pokok) }}</td>
          </tr>
          {{-- <tr>
            <td width="40%" class="service">Tunjangan Jabatan</td>
            <td width="25%" class="desc">:</td>
            <td class="unit">Rp. {{ number_format($tunjangan_jabatan) }}</td>
          </tr> --}}
          <tr>
            <td width="40%" class="service">Tunjangan Pasangan</td>
            <td width="25%" class="desc">:</td>
            <td class="unit">Rp. {{ number_format($tunjangan_pasangan) }}</td>
          </tr>
          <tr>
            <td width="40%" class="service">Tunjangan Anak</td>
            <td width="25%" class="desc">:</td>
            <td class="unit">Rp. {{ number_format($tunjangan_anak) }}</td>
          </tr>
          {{-- <tr>
            <td width="40%" class="service">Tunjangan Makan</td>
            <td width="25%" class="desc">:</td>
            <td class="unit">Rp.{{ number_format($tunjangan_makan) }}</td>
          </tr> --}}
          <tr>
            <td width="40%" class="service">Tunjangan Transport</td>
            <td width="25%" class="desc">:</td>
            <td class="unit">Rp. {{ number_format($tunjangan_transport) }}</td>
          </tr>
          <tr>
            <td colspan="2" class="grand total">TOTAL GAJI</td>
            <td class="grand total">Rp. {{ number_format($total_gaji) }}</td>
          </tr>
        </tbody>
      </table><br><br>
      <div id="company" class="clearfix">
        @foreach ($setting as $s)
          <div>{{ $tanggal }}</div>
          <div>{{ $s->jabatan }}</div>
          {{-- <div><img src="{{ asset('storage/' . $s->ttd_pimpinan) }}" width="100px" alt=""></div>   --}}
          <div><img src="{{ public_path('storage/' . $s->ttd_pimpinan) }}" width="100px" alt=""></div>  
          <div>{{ $s->pimpinan }}</div>
        @endforeach
      </div>  
  </body>
</html>