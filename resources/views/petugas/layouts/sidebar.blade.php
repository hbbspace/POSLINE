<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/petugas') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('petugas/dataPetugas') }}" class="nav-link {{ $activeMenu == 'dataPetugas' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profile</p>
                </a>
            </li>   
            <li class="nav-header">Pemeriksaan</li>
            <li class="nav-item">
                <a href="{{ url('petugas/pemeriksaanBalita') }}" class="nav-link {{ $activeMenu == 'pemeriksaanBalita' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>List Pemeriksaan Balita</p>
                </a>
            </li>   
            <li class="nav-item">
                <a href="{{ url('petugas/historyPemeriksaan') }}" class="nav-link {{ $activeMenu == 'hasilPemeriksaanBalita' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>History Pemeriksaan Balita</p>
                </a>
            </li>   
            <li class="nav-header">Jadwal Pemeriksaan</li>
            <li class="nav-item">
                <a href="{{ url('petugas/jadwal') }}" class="nav-link {{ $activeMenu == 'jadwal' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>Jadwal</p>
                </a>
            </li>   
            <li class="nav-header">                <a href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </nav>
</div>