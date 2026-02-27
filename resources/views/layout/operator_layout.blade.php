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
                        <li class="nav-item dropdown">
                             <a class="dropdown-toggle profile-pic d-flex align-items-center"
                                data-toggle="dropdown"
                                href="#"
                                aria-expanded="false">

                                <img src="{{ asset('storage/' . auth()->user()->pegawai->foto) }}"
                                    class="rounded-circle border mr-2"
                                    style="width:28px; height:28px; object-fit:cover;">
                            </a>

                            <ul class="dropdown-menu dropdown-user">
                               <li>
                                    <div class="user-box">
                                        <div class="u-img">
                                            <img src="{{ asset('storage/' . auth()->user()->pegawai->foto) }}"
                                                alt="user"
                                                style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->username }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                            <a href="{{ route('profil.index') }}" class="btn btn-rounded btn-danger btn-sm" data-toggle="modal" data-target="#modalProfil"> Lihat Profil </a>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profil.edit') }}"><i class="ti-user"></i> Edit Profil</a>
                                    <a class="dropdown-item" href="#"><i class="ti-settings"></i> Pengaturan</a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            </div>
            <div class="sidebar">
                <div class="scrollbar-inner sidebar-wrapper">
                @auth
                <div class="user">
                        <div class="photo">
                            <img src="{{ asset('storage/' . auth()->user()->pegawai->foto) }}">
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

                        {{-- BERANDA OPERATOR --}}
                        <li class="nav-item {{ Request::routeIs('operator.dashboard') ? 'active' : '' }}">
                            <a href="{{ url('operator/dashboard') }}">
                                <i class="bi bi-speedometer" style="font-size: 18px;"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- DATA BARANG --}}
                        <li class="nav-item {{ request()->is('operator/barang') ? 'active' : '' }}">
                            <a href="{{ url('operator/barang') }}">
                                <i class="bi bi-box-seam" style="font-size: 18px;"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>

                        {{-- BARANG MASUK --}}
                        <li class="nav-item {{ request()->is('operator/barang_masuk*') ? 'active' : '' }}">
                            <a href="{{ url('operator/barang_masuk') }}">
                                <i class="bi bi-box-seam-fill" style="font-size: 18px;"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>

                        {{-- BARANG KELUAR --}}
                        <li class="nav-item {{ request()->is('operator/barang_keluar*') ? 'active' : '' }}">
                            <a href="{{ url('operator/barang_keluar') }}">
                                <i class="bi bi-dropbox" style="font-size: 18px;"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>

                        {{-- NOTIFIKASI --}}
                        <li class="nav-item {{ Request::routeIs('operator.notifikasi') ? 'active' : '' }}">
                            <a href="{{ url('operator/notifikasi') }}">
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

    <div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="modalProfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProfilLabel">Profil Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <div class="row">

                        <!-- FOTO + NAMA -->
                        <div class="col-md-4 text-center border-right">
                            <img src="{{ asset('storage/' . auth()->user()->pegawai->foto) }}"
                                class="rounded-circle mb-3"
                                width="120"
                                height="120"
                                style="object-fit:cover;">

                            <h5 class="mb-0">{{ auth()->user()->pegawai->nama_pegawai }}</h5>
                            <small class="text-muted">{{ auth()->user()->pegawai->jabatan }}</small>
                        </div>

                        <!-- DATA -->
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">NIP</th>
                                    <td>: {{ auth()->user()->pegawai->nip }}</td>
                                </tr>
                                <tr>
                                    <th>NIP BPS</th>
                                    <td>: {{ auth()->user()->pegawai->nip_bps }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pegawai</th>
                                    <td>: <span class="badge badge-success">{{ auth()->user()->pegawai->status_pegawai }}</span></td>
                                </tr>
                                <tr>
                                    <th>Subbagian / Seksi</th>
                                    <td>: {{ auth()->user()->pegawai->subbagian}}</td>
                                </tr>
                                <tr>
                                    <th>Golongan</th>
                                    <td>: {{ auth()->user()->pegawai->golongan_akhir }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan</th>
                                    <td>: {{ auth()->user()->pegawai->pendidikan }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tgl Lahir</th>
                                    <td>: {{ auth()->user()->pegawai->tempat_lahir }}, {{ \Carbon\Carbon::parse(auth()->user()->pegawai->tanggal_lahir)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: {{ auth()->user()->pegawai->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>: {{ auth()->user()->pegawai->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Username Akun</th>
                                    <td>: {{ Auth::user()->username }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
