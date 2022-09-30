<!DOCTYPE html>
<head>
    <title>Surat Penerimaan Cuti</title>
    <meta charset="utf-8">
    <style>
        #judul{
            text-align:center;
        }

        #halaman{
            width: auto; 
            height: auto; 
            position: relative; 
            border: 1px solid; 
            padding-top: 30px; 
            padding-left: 30px; 
            padding-right: 30px; 
            padding-bottom: 80px;
        }

    </style>

</head>

<body>
    <div id=halaman>
        <h3 id=judul>SURAT PENERIMAAN CUTI</h3>

        <br>

        <p>Menindak lanjuti permohonan izin saudara / saudari perihal permohonan cuti, 
            saya yang bertanda tangan dibawah ini :</p>

        <table>
            @foreach($setting as $s)
            <tr>
                <td style="width: 40%;">Nama</td>
                <td style="width: 10%;">:</td>
                <td style="width: 65%;">{{ $s->kepala_sekolah }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">Jabatan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">Kepala Sekolah</td>
            </tr>
            @endforeach
        </table>

        <p>Menerangkan Bahwa :</p>

        <table>
            <tr>
                <td style="width: 35%;">Nama </td>
                <td style="width: 10%;">:</td>
                <td style="width: 65%;">{{ $cuti->pegawai->nama_lengkap }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">NIP</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $cuti->pegawai->nip }}</td>
            </tr>
            {{-- @foreach ($jabatan as $j)
            <tr>
                <td style="width: 30%;">Jabatan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">{{ $j->jabatan->nama_jabatan }}</td>
            </tr>
            @endforeach --}}
            
        </table>

        <p>Setuju untuk memberikan cuti pada tanggal {{ $cuti->tgl_mulai }} sampai dengan tanggal {{ $cuti->tgl_selesai }}</p>

        <br>

        <div style="width: 50%; text-align: left; float: right;">{{ $tanggal }}</div><br><br>
        @foreach ($setting as $s)
            <div style="width: 50%; text-align: left; float: right;">Kepala Sekolah,</div><br><br>
            <div style="width: 50%; text-align: left; float: right;"><img src="{{ public_path('storage/' . $s->ttd_pimpinan) }}" width="110px" alt=""></div><br><br><br><br><br>
            <div style="width: 50%; text-align: left; float: right;">{{ $s->kepala_sekolah }}</div>
        @endforeach
       

    </div>
</body>

</html>