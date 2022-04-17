<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMPEG <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/userhome')}}">
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
        <a class="nav-link" href="{{url('user')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Profil</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{url('pegawai/absensi')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Absensi</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('pegawai/absensi/laporan/show')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Laporan Absensi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>