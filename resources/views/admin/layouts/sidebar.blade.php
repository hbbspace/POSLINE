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
                <a href="{{ url('/admin') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('admin/dataAdmin') }}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data Super Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/dataKeluarga') }}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data KK</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/dataIbu') }}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data Orang Tua</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/dataAnak') }}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data Anak</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/dataPetugas') }}" class="nav-link ">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data Petugas Posyandu</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/dataUser') }}" class="nav-link ">
                    <i class="nav-icon far fa-user"></i>
                    <p>Data User</p>
                </a>
            <li class="nav-header">Data Jadwal</li>
            <li class="nav-item">
                <a href="{{ url('admin/jadwal') }}" class="nav-link  ">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Jadwal</p>
                </a>
            </li>
            <li class="nav-header">Data Pemeriksaan</li>
            <li class="nav-item">
                <a href="{{ url('admin/dataPemeriksaan') }}" class="nav-link  ">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Data Pemeriksaan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
