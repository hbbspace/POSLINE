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
                <a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('user/dataUser') }}" class="nav-link {{ $activeMenu == 'dataUser' ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data Pengguna</p>
                </a>
            </li>
            <li class="nav-header">Balita</li>
            <li class="nav-item">
                <a href="{{ url('user/dataBalitaUser') }}" class="nav-link {{ $activeMenu == 'dataBalitaUser' ? 'active' : '' }}">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>Data Balita</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('user/dataPemeriksaanBalita') }}" class="nav-link {{ $activeMenu == 'dataPemeriksaanBalita' ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Riwayat Pemeriksaan</p>
                </a>
            </li>
            <li class="nav-header">Data Jadwal</li>
            <li class="nav-item">
                <a href="{{ url('user/jadwal') }}" class="nav-link {{ $activeMenu == 'jadwal' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <li class="nav-header">                <a href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </nav>
</div>
