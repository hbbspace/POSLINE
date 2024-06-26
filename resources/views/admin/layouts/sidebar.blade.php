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
                <a href="{{ url('/admin') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item has-treeview {{ in_array($activeMenu, ['dataAdmin', 'dataKeluarga', 'dataAnggotaKeluarga', 'dataAnak', 'dataPetugas', 'dataUser']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array($activeMenu, ['dataAdmin', 'dataKeluarga', 'dataAnggotaKeluarga', 'dataAnak', 'dataPetugas', 'dataUser']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Data Pengguna
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/dataAdmin') }}" class="nav-link {{ $activeMenu == 'dataAdmin' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Data Super Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dataKeluarga') }}" class="nav-link {{ $activeMenu == 'dataKeluarga' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data KK</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dataIbu') }}" class="nav-link {{ $activeMenu == 'dataAnggotaKeluarga' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-female"></i>
                            <p>Data Orang Tua</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dataAnak') }}" class="nav-link {{ $activeMenu == 'dataAnak' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-child"></i>
                            <p>Data Anak</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dataPetugas') }}" class="nav-link {{ $activeMenu == 'dataPetugas' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-nurse"></i>
                            <p>Data Petugas Posyandu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dataUser') }}" class="nav-link {{ $activeMenu == 'dataUser' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">Data Jadwal</li>
            <li class="nav-item">
                <a href="{{ url('admin/jadwal') }}" class="nav-link {{ $activeMenu == 'jadwal' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <li class="nav-header">Data Pemeriksaan</li>
            <li class="nav-item has-treeview {{ in_array($activeMenu, ['dataPemeriksaan', 'pemeriksaan']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array($activeMenu, ['dataPemeriksaan', 'pemeriksaan']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-notes-medical"></i>
                    <p>
                        Data Pemeriksaan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/dataPemeriksaan') }}" class="nav-link {{ $activeMenu == 'dataPemeriksaan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Data Pemeriksaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/pemeriksaan') }}" class="nav-link {{ $activeMenu == 'pemeriksaan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-notes-medical"></i>
                            <p>Input Pemeriksaan</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
