 <!-- ========== Left Sidebar Start ========== -->
 <div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="/landing/assets/img/simanwai.png" alt="" height="48">
        </span>
        <span class="logo-sm">
            <img src="/hyper/assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="/hyper/assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="/hyper/assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="/dashboard" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Apps</li>

            @if (auth()->user()->role == "Super Admin")

            <li class="side-nav-item">
                <a href="/dataSekolah" class="side-nav-link">
                    <i class="uil-user-plus"></i>
                    <span> Data Sekolah </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/daftar-pegawai" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Data User </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Master Data </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="master">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/masterAsn">Guru ASN</a>
                        </li>
                        <li>
                            <a href="/masterPppk">Guru PPPK</a>
                        </li>
                        <li>
                            <a href="/tunjangan">Guru Honorer</a>
                        </li>
                    </ul>
                </div>
            </li>

            


          @endif
  
            
          @if (auth()->user()->role == "Admin")

            <li class="side-nav-item">
                <a href="/daftar-user" class="side-nav-link">
                    <i class="uil-user-plus"></i>
                    <span> Data User </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#pegawai" aria-expanded="false" aria-controls="pegawai" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Data Pegawai </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="pegawai">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/daftar-pegawai">Data Pegawai</a>
                        </li>
                        <li>
                            <a href="/jabatanPegawai">Jabatan Pegawai</a>
                        </li>
                        {{-- <li>
                            <a href="/mapelGuru">Mapel Guru</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#guru" aria-expanded="false" aria-controls="guru" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Data Guru </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="guru">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/dataGuruASN">Data Guru PNS</a>
                        </li>
                        <li>
                            <a href="/dataGuruPPPK">Data Guru PPPK</a>
                        </li>
                        <li>
                            <a href="/dataGuruHonorer">Data Guru Honorer</a>
                        </li>
                        <li>
                            <a href="/dataPegawaiSekolah">Data Pegawai Sekolah</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#siswa" aria-expanded="false" aria-controls="siswa" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Data Siswa </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="siswa">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/dataSiswa">Data Siswa</a>
                        </li>
                        <li>
                            <a href="/angkatan">Data Angkatan</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#presensi" aria-expanded="false" aria-controls="presensi" class="side-nav-link">
                    <i class="uil-clock-seven"></i>
                    <span> Data Presensi </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="presensi">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/data-presensi">Data Presensi</a>
                        </li>
                        <li>
                            <a href="/rekapPresensiAdmin">Rekap Presensi</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#divisi" aria-expanded="false" aria-controls="divisi" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Master Data </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="divisi">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/jabatan">Jabatan</a>
                        </li>
                        {{-- <li>
                            <a href="/mapel">Mapel</a>
                        </li> --}}
                        <li>
                            <a href="/tunjangan">Tunjangan</a>
                        </li>
                        {{-- <li>
                            <a href="/kategoriDok">Kategori Dokumen</a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#dataguru" aria-expanded="false" aria-controls="dataguru" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Master Data Guru</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="dataguru">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/guruASN">Gaji Guru PNS</a>
                        </li>
                        <li>
                            <a href="/guruPPPK">Gaji Guru PPPK</a>
                        </li>
                        {{-- <li>
                            <a href="/guruHonorer">Gaji Guru Honorer</a>
                        </li> --}}
                    </ul>
                </div>
            </li>


            
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#gaji" aria-expanded="false" aria-controls="gaji" class="side-nav-link">
                    <i class="uil-bill"></i>
                    <span> Data Gaji </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="gaji">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/gajiPegawai">Gaji Pegawai</a>
                        </li>
                        <li>
                            <a href="/riwayatGaji">Riwayat Gaji</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#dokumen" aria-expanded="false" aria-controls="dokumen" class="side-nav-link">
                    <i class="uil-files-landscapes"></i>
                    <span> Dokumen </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="dokumen">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/dokumen">Dokumen Pegawai</a>
                        </li>
                        <li>
                            <a href="/dokSiswa">Dokumen Siswa</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="/dokumenManager" class="side-nav-link">
                    <i class="uil-folder-check"></i>
                    <span> File Manager </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/dataCuti" class="side-nav-link">
                    <i class="uil-dna"></i>
                    <span> Data Cuti </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/setting" class="side-nav-link">
                    <i class="uil-server"></i>
                    <span> Setting </span>
                </a>
            </li>

          @endif

          @if (auth()->user()->role == "Pegawai")

          <li class="side-nav-item">
              <a href="/data-diri" class="side-nav-link">
                  <i class="uil-user-plus"></i>
                  <span> Data Diri</span>
              </a>
          </li>

        <li class="side-nav-item">
            <a href="/presensi" class="side-nav-link">
                <i class="uil-monitor"></i>
                <span> Presensi </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/gajiUserPegawai" class="side-nav-link">
                <i class="uil-bill"></i>
                <span> Gaji </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/dokumenPegawai" class="side-nav-link">
                <i class="uil-files-landscapes"></i>
                <span> Dokumen </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/cutiPegawai" class="side-nav-link">
                <i class="uil-dna"></i>
                <span> Cuti </span>
            </a>
        </li>

        @endif

        @if(auth()->user()->role == "Siswa")

        <li class="side-nav-item">
            <a href="/profileSiswa" class="side-nav-link">
                <i class="uil-user-plus"></i>
                <span> Profile Siswa</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/dokumenSiswa" class="side-nav-link">
                <i class="uil-files-landscapes"></i>
                <span> Dokumen </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/fileManagerSiswa" class="side-nav-link">
                <i class="uil-folder-check"></i>
                <span> File Manager </span>
            </a>
        </li>   

        @endif


        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->