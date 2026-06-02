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
    <style>
        table thead th {
            text-align: center;
        }
        </style><style>
    table.dataTable thead th {
        text-align: center !important;
    }

    /* LOGO HEADER TETAP NORMAL */
    .logo-header{
        width:250px !important;
    }

    /* SIDEBAR mulai di bawah logo */
    .sidebar{
        width:250px;
        transition:all .3s ease;
    }

    .sidebar-wrapper{
        width:250px;
        transition:all .3s ease;
    }

    /* MAIN PANEL */
    .main-panel{
        width:calc(100% - 250px);
        transition:all .3s ease;
    }

    /* ===== COLLAPSE ===== */
    .wrapper.sidebar-collapsed .sidebar{
        width:80px;
    }

    .wrapper.sidebar-collapsed .sidebar-wrapper{
        width:80px;
    }

    .wrapper.sidebar-collapsed .main-panel{
        width:calc(100% - 80px);
    }

    /* sembunyikan profil */
    .wrapper.sidebar-collapsed .sidebar .user{
        display:none;
    }

    /* sembunyikan teks menu */
    .wrapper.sidebar-collapsed .sidebar .nav p{
        display:none;
    }

    /* center icon */
    .wrapper.sidebar-collapsed .sidebar .nav li a{
        justify-content:center;
    }

    .wrapper.sidebar-collapsed .sidebar .nav i{
        margin:0;
        font-size:22px;
    }

    .sidebar {
    overflow: hidden;
    }

    .sidebar-wrapper {
        height: calc(100vh - 70px); /* sesuaikan header */
        overflow-y: auto;
    }

    .sidebar .nav {
        margin-bottom: 20px;
    }

    .sidebar .nav li a {
        white-space: nowrap;
    }

    .sidebar-wrapper {
    height: 100vh;
    overflow-y: auto;

    /* sembunyikan scrollbar (Chrome, Edge, Safari) */
    scrollbar-width: none;        /* Firefox */
    -ms-overflow-style: none;     /* IE/Edge lama */
    }

    .sidebar-wrapper::-webkit-scrollbar {
        display: none; /* Chrome, Safari */
    }
    </style>
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
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <button id="toggleSidebar" class="btn btn-sm btn-primary mr-3">
                        <i class="bi bi-chevron-left" id="iconToggle"></i>
                    </button>
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
                                <span class="notification">{{ $totalNotif }}</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-title">
                                        @if($totalNotif > 0)
                                            Ada {{ $totalNotif }} notifikasi stok
                                        @else
                                            Tidak ada notifikasi
                                        @endif
                                    </div>
                                </li>

                                <li>
                                    <div class="notif-center">

                                        {{-- Barang Habis --}}
                                        @foreach($barangHabis as $item)
                                        <a href="{{ route('admin.barang.index') }}">
                                            <div class="notif-icon notif-danger">
                                                <i class="la la-times-circle"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    {{ $item->nama_barang }} habis
                                                </span>
                                                <span class="time">
                                                    Stok: 0
                                                </span>
                                            </div>
                                        </a>
                                        @endforeach


                                        {{-- Barang Menipis --}}
                                        @foreach($barangMenipis as $item)
                                        <a href="{{ route('admin.barang.index') }}">
                                            <div class="notif-icon notif-warning">
                                                <i class="la la-exclamation-circle"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    {{ $item->nama_barang }} menipis
                                                </span>
                                                <span class="time">
                                                    Sisa: {{ $item->stok }}
                                                </span>
                                            </div>
                                        </a>
                                        @endforeach

                                    </div>
                                </li>

                                <li>
                                    <a class="see-all" href="{{ route('admin.barang.index') }}">
                                        <strong>Lihat Semua Barang</strong>
                                        <i class="la la-angle-right"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="see-all text-danger" href="{{ route('notif.clear', $totalNotif) }}">
                                        <strong>Clear Notifikasi</strong>
                                    </a>
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

                                <a class="dropdown-item" href="#" onclick="confirmLogout()">
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
                <div class="sidebar-wrapper">
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
                        {{-- Riwayat Permintaan (INDEX) --}}
                        <li class="nav-item {{ Request::is('admin/usulan_barang') ? 'active' : '' }}">
                            <a href="{{ url('admin/usulan_barang') }}">
                                <i class="bi bi-chat-left-text-fill" style="font-size: 18px;"></i>
                                <p>Usulan Barang</p>
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
                            &copy; 2026 Sistem Informasi ATK - BPS Kabupaten Banjar
                        </div>
                    </div>
                </footer>
                </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- POPUP BERHASIL --}}
    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    })
    </script>
    @endif

    {{-- POPUP GAGAL --}}
    @if(session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: '{{ session('error') }}'
    })
    </script>
    @endif

    {{-- KONFIRMASI HAPUS DINAMIS --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const forms = document.querySelectorAll(".form-hapus");

        forms.forEach(form => {
            form.addEventListener("submit", function (e) {
                e.preventDefault();

                let jenisData = form.getAttribute("data-judul");

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin ingin menghapus data ' + jenisData + ' ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    });
    </script>

    <script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kamu akan keluar dari sistem",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
    </script>

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @yield('scripts')
    <script>
    const wrapper = document.querySelector(".wrapper");
    const icon = document.getElementById("iconToggle");

    // load state
    if(localStorage.getItem("sidebar") === "collapsed"){
        wrapper.classList.add("sidebar-collapsed");
        icon.classList.replace("bi-chevron-left","bi-chevron-right");
    }

    document.getElementById("toggleSidebar").onclick = function(){
        wrapper.classList.toggle("sidebar-collapsed");

        if(wrapper.classList.contains("sidebar-collapsed")){
            icon.classList.replace("bi-chevron-left","bi-chevron-right");
            localStorage.setItem("sidebar","collapsed");
        }else{
            icon.classList.replace("bi-chevron-right","bi-chevron-left");
            localStorage.setItem("sidebar","open");
        }
    }
    </script>
    <script>
    window.onload = function () {
        let input = document.getElementById("tanggal_lahir");

        if (input) {
            let today = new Date();
            let minAge = 18;

            let maxDate = new Date(
                today.getFullYear() - minAge,
                today.getMonth(),
                today.getDate()
            );

            input.max = maxDate.toISOString().split('T')[0];
        }
    }
    </script>
</body>
</html>
