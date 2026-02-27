<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('assets/img/logo BPS.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('styles')

</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a class="logo d-flex align-items-center">
                    <img src="{{ asset('assets/img/logo BPS.png') }}"
                        alt="Logo BPS"
                        style="height: 30px; margin-right: 8px;">
                    ATK BPS Banjar
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <form method="GET" action="{{ url()->current() }}"
                        class="navbar-left navbar-form nav-search mr-md-3">

                        <div class="input-group">
                            <input type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Search ..."
                                class="form-control">

                            <div class="input-group-append">
                                <button type="submit" class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="{{ asset('assets/img/profile2.jpg')}}" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        @auth
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic d-flex align-items-center"
                            data-toggle="dropdown"
                            href="#">
                                <span style="
                                    width:36px;
                                    height:36px;
                                    border-radius:50%;
                                    background:#4e73df;
                                    color:#fff;
                                    display:inline-flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-weight:bold;
                                    margin-right:8px;
                                ">
                                    A
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img">
                                            <div style="
                                                width:80px;
                                                height:80px;
                                                border-radius:50%;
                                                background:#4e73df;
                                                color:#fff;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                font-size:32px;
                                                font-weight:bold;
                                            ">
                                                A
                                            </div>
                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->username }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endauth

                    </ul>
                </div>
            </nav>
            </div>
            <div class="sidebar">
                <div class="scrollbar-inner sidebar-wrapper">
                @auth
                <div class="user">
                    <div class="photo">
                        <div style="
                            width:42px;
                            height:42px;
                            border-radius:50%;
                            background:#4e73df;
                            color:#fff;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-weight:bold;
                        ">
                            A
                        </div>
                    </div>
                    <div class="info">
                        <a aria-expanded="true">
                            <span>
                                {{ Auth::user()->username }}
                                <span class="user-level">
                                    {{ ucfirst(Auth::user()->level) }}
                                </span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endauth

                <ul class="nav">

                        {{-- BERANDA ADMIN --}}
                        <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="bi bi-speedometer" style="font-size: 18px;"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- DATA AKUN --}}
                        <li class="nav-item {{ request()->is('admin/akun*') ? 'active' : '' }}">
                            <a href="{{ url('admin/akun') }}">
                                <i class="bi bi-person-fill-add" style="font-size: 18px;"></i>
                                <p>Akun</p>
                            </a>
                        </li>

                        {{-- DATA PEGAWAI --}}
                        <li class="nav-item {{ request()->is('admin/pegawai*') ? 'active' : '' }}">
                            <a href="{{ url('admin/pegawai') }}">
                                <i class="bi bi-person-rolodex" style="font-size: 18px;"></i>
                                <p>Data Pegawai</p>
                            </a>
                        </li>

                        {{-- DATA BARANG --}}
                        <li class="nav-item {{ request()->is('admin/barang') ? 'active' : '' }}">
                            <a href="{{ url('admin/barang') }}">
                                <i class="bi bi-box-seam" style="font-size: 18px;"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>

                        {{-- BARANG MASUK --}}
                        <li class="nav-item {{ request()->is('admin/barang_masuk*') ? 'active' : '' }}">
                            <a href="{{ url('admin/barang_masuk') }}">
                                <i class="bi bi-box-seam-fill" style="font-size: 18px;"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>

                        {{-- BARANG KELUAR --}}
                        <li class="nav-item {{ request()->is('admin/barang_keluar*') ? 'active' : '' }}">
                            <a href="{{ url('admin/barang_keluar') }}">
                                <i class="bi bi-dropbox" style="font-size: 18px;"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>

                        {{-- KARTU PERSEDIAAN --}}
                        <li class="nav-item {{ request()->is('admin/kartu_persediaan') ? 'active' : '' }}">
                            <a href="{{ url('admin/kartu_persediaan') }}">
                                <i class="bi bi-card-list" style="font-size: 18px;"></i>
                                <p>Laporan Persediaan</p>
                            </a>
                        </li>

                        {{-- NOTIFIKASI --}}
                        <li class="nav-item {{ Request::routeIs('admin.notifikasi') ? 'active' : '' }}">
                            <a href="{{ url('admin/notifikasi') }}">
                                <i class="bi bi-bell" style="font-size: 18px;"></i>
                                <p>Notifikasi</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel" style="background: url('{{ asset('assets/img/bg.png') }}') no-repeat center center fixed; background-size: cover;">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright ml-auto">
                            2025, made with <i class="la la-heart heart text-danger"></i> by <a href="http://www.themekita.com">BPS Kabupaten Banjar</a>
                        </div>
                    </div>
                </footer>
                </div>
            </div>
    </div>
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
                    <p>
                        <b>We'll let you know when it's done</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/ready.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    @yield('scripts')
</body>
</html>
