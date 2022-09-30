<ul class="nav nav-tabs nav-bordered mb-3">
    <li class="nav-item">
        <a href="/ortu/{{ Crypt::encrypt($pegawai->id) }}" class="nav-link {{ ($active=="ortu") ? 'active' : '' }}">
            Orang Tua
        </a>
    </li>
    <li class="nav-item">
        <a href="/pasangan/{{ Crypt::encrypt($pegawai->id) }}" class="nav-link {{ ($active=="pasangan") ? 'active' : '' }}">
            Pasangan
        </a>
    </li>
    <li class="nav-item">
        <a href="/anak/{{ Crypt::encrypt($pegawai->id) }}"  class="nav-link {{ ($active=="anak") ? 'active' : '' }}">
            Anak
        </a>
    </li>
</ul> <!-- end nav-->