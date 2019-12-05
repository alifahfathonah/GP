<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="/">GPrivat</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          @if( Auth::user()->join('roles','roles.id_role','=','users.id_role')->find(Auth::id())->n_role != 'pengajar' )
          <img class="img-responsive img-rounded" src="{!! asset('storage/img/profile.png')!!}"
            alt="User picture">
            
          @else
          @php
            $pengajar = \App\User::join('pengajars','pengajars.email','=','users.email')                        
                              ->where('pengajars.email',Auth::user()->email)
                              ->join('keahlians','keahlians.id_keahlian','=','pengajars.id_keahlian')
                              ->get();
            @endphp
          @if($pengajar->pluck('foto')->first() == "")
          <img class="img-responsive img-rounded" src="{!! asset('storage/img/profile.png')!!}"
            alt="User picture">
          @else            
          <img class="img-responsive img-rounded" src="{!! asset('storage/'.$pengajar->pluck('foto')->first())!!}"
            alt="User picture">
          @endif
        @endif
        </div>
        <div class="user-info">
          <span class="user-name"> <strong>{{Auth::user()->name}}</strong>         
          </span>
          <span class="user-role">{{ Auth::user()->join('roles','roles.id_role','=','users.id_role')->find(Auth::id())->n_role  }}</span>
        </div>
      </div>
      <!-- sidebar-header  -->

      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Menu</span>
          </li>
          <!-- dropdown multi start -->
          <!-- <li class="sidebar-dropdown">  
            <a href="#">
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
              <span class="badge badge-pill badge-warning">New</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Dashboard 1
                    <span class="badge badge-pill badge-success">Pro</span>
                  </a>
                </li>
                <li>
                  <a href="#">Dashboard 2</a>
                </li>
                <li>
                  <a href="#">Dashboard 3</a>
                </li>
              </ul>
            </div>
          </li> -->
          <!-- dropdown multi end -->

          @if(Auth::check() && strtoupper(Auth::user()->join('roles','roles.id_role','=','users.id_role')->find(Auth::id())->n_role) == strtoupper('client') )
          <li>
            <a href="/profil">
              <i class="fa fa-user"></i>
              <span>Profil</span>            
            </a>
          </li>
          <li class="sidebar-dropdown">  
            <a href="#">
            <i class="fas fa-history"></i>
              <span>Riwayat Transaksi</span>              
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="/transaksi/ditolak">Transaksi Ditolak
                  </a>
                </li>
                <li>
                  <a href="/transaksi/diterima">Transaksi Diterima</a>
                </li>
                <li>
                  <a href="/transaksi/belajar">Transaksi Belajar</a>
                </li>
              </ul>
            </div>
          </li> 
          <li>
            <a href="/transaksi/pending">
            <i class="fas fa-book"></i>
              <span>Booking </span>
            </a>
          </li>
          @elseif(Auth::check() && strtoupper(Auth::user()->join('roles','roles.id_role','=','users.id_role')->find(Auth::id())->n_role) == strtoupper('pengajar'))
          <li>
            <a href="/profil">
              <i class="fa fa-user"></i>
              <span>Profil</span>            
            </a>
          </li>         
          <li>
            <a href="/dt-booking">
            <i class="fas fa-list-ol"></i>
              <span>Daftar Pemesanan</span>
            </a>
          </li>
          <li>
            <a href="/history">
            <i class="fas fa-history"></i>
              <span>Riwayat Transaksi</span>
            </a>
          </li>
          @elseif(Auth::check() && strtoupper(Auth::user()->join('roles','roles.id_role','=','users.id_role')->find(Auth::id())->n_role) == strtoupper('admin'))
          <li>
            <a href="/profil">
              <i class="fa fa-user"></i>
              <span>Profil</span>            
            </a>
          </li>
          <li>
            <a href="/dt-keahlian">
            <i class="fas fa-wrench"></i>
              <span>Data Keahlian</span>            
            </a>
          </li>
          <li class="sidebar-dropdown">  
            <a href="#">
            <i class="fas fa-money-bill-alt"></i>
              <span>Data Transaksi</span>              
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="/dt-transaksi">Semua Transaksi
                  </a>
                </li>

                <li>
                  <a href="/dt-transaksi/pending">Transaksi Butuh Konfirmasi</a>
                </li>

                <li>
                  <a href="/dt-transaksi/proses">Transaksi Proses Belajar</a>
                </li>

                <li>
                  <a href="/dt-transaksi/finish">Transaksi Selesai</a>
                </li>
              </ul>            
            </div>
          </li> 
          @else
          <li>
            <a href="/profil">
              <i class="fa fa-user"></i>
              <span>Profil</span>            
            </a>
          </li>
          <li>
            <a href="/dt-admin">
              <i class="fas fa-user-secret"></i>
              <span>Data Admin</span>            
            </a>
          </li>
          <li>
            <a href="/dt-keahlian">
              <i class="fas fa-wrench"></i>
              <span>Data Keahlian</span>            
            </a>
          </li>
          
          <li>
            <a href="/laporan/transaksi">
            <i class="fas fa-file-invoice"></i>
              <span>Laporan Transaksi</span>            
            </a>
          </li>
          <li>
          
          @endif

        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
    <form action="{{ route('logout') }}" method="post" class="m-1">
    @csrf
      <button class="btn btn-sm btn-outline-danger">
        <i class="fa fa-power-off"></i>
    </button>
    </form>
    </div>
  </nav>
  