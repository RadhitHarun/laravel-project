<nav class="navbar navbar-light bg-body-tertiary sticky-top shadow ">
  <div class="container-fluid">

    <!-- Menggunakan "d-flex" agar elemen berbaris secara horisontal -->
    <div class="d-flex justify-content-start">

      <!-- Tombol "navbar-toggler" -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      {{-- canvas --}}
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title d-flex justify-content-center align-items-center" id="offcanvasNavbarLabel">
            <i class="far fa-user-circle ms-2" id="iconUser"></i>|  Hi,<i class="ms-2"><strong><i>{{ auth()->user()->name }}</i></strong></i>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr style="border-color: black"> 

        {{-- canvas body --}}
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1">
            <li class="nav-item">

              {{-- Dashboard Admin --}}
              @if (auth()->user()->level == 1)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.DashboardAdmin') }}" id="Dashboard_Admin">
                  <i class="fas fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
              </li>
              @endif

              {{-- Dashboard Foreman --}}
              @if (auth()->user()->level == 2)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('foreman.DashboardForeman') }}" id="Dashboard_Foreman">
                  <i class="fas fa-tachometer-alt"></i>
                  <span>Current Process</span></a>
              </li>
              @endif

              {{-- Downtime Idle (member Only) --}}
              @if(auth()->user()->level == 3)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('member.index') }}">
                  <i class="fas fa-home"></i>
                  <span>HOME</span></a>
              </li>
              @endif

              @if(Auth()->user()->level == 3)
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-list-alt"></i>
                  <span>JOB</span></a>
              </li>
              @endif

              @if(Auth()->user()->level == 2)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('foreman.ListValidasiJob') }}">
                  <i class="fas fa-user-check"></i>
                  <span>Validasi Job</span></a>
                  <span class="badge badge-danger" id="notification-badge" style="display: none;">New</span>
              </li>
              @endif

              @if(auth()->user()->level == 1)
              <li class="nav-item">
                <a href="{{ route('project.index') }}" class="nav-link">
                <i class="fas fa-list-alt"></i>
                <span>Project</span></a>
              </li>
              @endif

              {{-- Report Workstation(Foreman Only) --}}
              @if(auth()->user()->level == 2)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('workstation.index') }}">
                  <i class="fas fa-table"></i>
                    <span>Report Workstation</span>
                </a>
              </li>
              @endif

              {{-- LJKH(Admin Only) --}}
              @if (auth()->user()->level == 1)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.ljkh') }}">
                  <i class="fas fa-table"></i>
                  <span>LJKH</span></a>
              </li>
              @endif
              
              {{-- User Setting (Admin Only) --}}
              @if (auth()->user()->level == 1)
              <li class="nav-item">
                <a class="nav-link" href="/profile">
                  <i class="fas fa-user-alt"></i>
                  <span>Profile</span></a>
              </li>
              @endif

            </li>
          </ul>
        </div>

  <!-- Menambahkan kelas "mt-auto" untuk mengatur posisi div di pojok bawah -->
        <div class="offcanvas-footer mt-auto"> 
          <hr style="border-color: black">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>

      <!-- gambar navbar -->
      <a class="navbar-brand ms-2" href="#">
        <img src="{{ asset('img/FTI_logo_color_horizontal_with_member_of_Astra.png') }}" id="gambarFTI" alt="">
      </a>

      <div class="container d-flex justify-content-end align-items-right">
        <div id="jamNavbar"></div>
      </div>
    </div>
  </div>
</nav>

@include('layouts.script')
