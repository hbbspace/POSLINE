@php
use App\Models\AnggotaKeluargaModel;

$nama_user = AnggotaKeluargaModel::select('anggota_keluarga.nama')
    ->join('user', 'user.nik', '=', 'anggota_keluarga.nik')
    ->where('user.user_id', Auth::guard('user')->user()->user_id)
    ->first();
@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1030;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    
  </ul>
  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    {{-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> --}}
    
    @if(Auth::guard('user')->check())
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/user/dataUser/') }}">
        <i class="fas fa-user"></i> <!-- Icon user -->
        {{ $nama_user->nama }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  @else
    <script>
      window.location.href = "{{ route('login') }}";
    </script>
  @endif
  </ul>
</nav>
