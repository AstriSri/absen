<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMPEG <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Main Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('pegawai.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Pegawai</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('dosen.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Dosen</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('agama.index') }}">Agama</a>
                <a class="collapse-item" href="{{ route('divisi.index') }}">Divisi</a>
                <a class="collapse-item" href="{{ route('golongan.index') }}">Golongan</a>
                <a class="collapse-item" href="{{ route('goldar.index') }}">Golongan Darah</a>
                <a class="collapse-item" href="{{ route('jabatan.index') }}">Jabatan</a>
                <a class="collapse-item" href="{{ route('jabatan-fungsional.index') }}">Jabatan Fungsional</a>
                <a class="collapse-item" href="{{ route('jeniskelamin.index') }}">Jenis Kelamin</a>
                <a class="collapse-item" href="{{ route('kewarganegaraan.index') }}">Kewarganegaraan</a>
                <a class="collapse-item" href="{{ route('pendidikan.index') }}">Pendidikan</a>
                <a class="collapse-item" href="{{ route('statuskerja.index') }}">Status Kerja</a>
                <a class="collapse-item" href="{{ route('statusdosen.index') }}">Status Dosen </a>
                <a class="collapse-item" href="{{ route('statusaktifdosen.index') }}">Status Aktif Dosen </a>
                <a class="collapse-item" href="{{ route('statuspegawai.index') }}">Status Pegawai</a>
                <a class="collapse-item" href="{{ route('dosen-homebase.index') }}">Homebase Dosen </a>
                <a class="collapse-item" href="{{ route('jam-kerja.index') }}">Jam Kerja</a>
                <a class="collapse-item" href="{{ route('jam-kerja-pegawai.index') }}">Jam Kerja Pegawai</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#idcardspan"
            aria-expanded="true" aria-controls="idcardspan">
            <i class="fas fa-fw fa-wrench"></i>
            <span>ID Card</span>
        </a>
        <div id="idcardspan" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('idcard.dosen.index') }}">Dosen</a>
                <a class="collapse-item" href="{{ route('idcard.pegawai.index') }}">Pegawai</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporanSpan"
            aria-expanded="true" aria-controls="laporanSpan">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
        </a>
        <div id="laporanSpan" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('laporan.absensi') }}">Absensi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/gantipassword')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Ganti Password</span></a>
    </li>

    @if(Auth::user()->username == "admin")
    <li class="nav-item">
        <a class="nav-link" href="{{url('admin/dataakun/cari')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Akun Terdaftar</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>