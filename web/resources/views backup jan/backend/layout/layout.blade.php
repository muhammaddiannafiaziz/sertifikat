<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Control Panel')</title>
    <!-- Menggunakan CDN Bootstrap dan Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Body */
        body {
            background-color: #f4f7fc;
            font-family: Arial, sans-serif;
            font-size: 12px;
            /* Ukuran font lebih kecil */
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background-color: #007bff;
            color: white;
            position: fixed;
            width: 200px;
            top: 20px;
            padding-top: 20px;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
            will-change: width;
        }

        .sidebar.hide {
            width: 70px;
        }

        .sidebar .nav {
            padding-left: 0;
        }

        .sidebar .nav-item {
            border-bottom: 1px solid #ffffff20;
        }

        .sidebar .nav-link {
            color: #e2f0ff;
            text-decoration: none;
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
            padding: 12px 30px;
            display: block;
            font-size: 14px;
            /* Ukuran font sidebar */
            transition: padding-left 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #0056b3;
        }

        .sidebar .menu-arrow {
            float: right;
        }

        .sidebar .collapse .nav-link {
            padding-left: 30px;
        }

        /* Styling untuk container search */
        .search-container {
            display: flex;
            align-items: center;
            margin-right: 500px;
        }

        .search-input {
            width: 200px;
            padding: 5px;
            font-size: 10px;
            /* Ukuran font input */
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        /* Main Content */
        .main-content {
            margin-left: 200px;
            padding: 30px;
            background-color: #f9f9f9;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content.shift {
            margin-left: 70px;
        }

        /* Navbar/Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            /* background-color: #badcff; */
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
        }

        header h1 {
            font-size: 14px;
            /* Ukuran font judul */
            margin: 0;
        }

        /* Button Toggle Sidebar */
        #toggleSidebar {
            background-color: white;
            border: none;
            color: #007bff;
            padding: 8px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        #toggleSidebar i {
            font-size: 18px;
        }

        /* Profil dan animasi status */
        .profile-dropdown {
            display: flex;
            align-items: center;
        }

        .profile-dropdown .username {
            margin-right: 5px;
            color: #000000;
            /* font-size: 10px; */
            /* Ukuran font username */
        }

        .btn.dropdown-toggle:hover {
            background-color: transparent;
            border: none;
        }

        /* Indikator status online */
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 5px;
            transition: background-color 0.3s ease;
        }

        /* Status Online */
        .status-indicator.online {
            background-color: #28a745;
            border: 2px solid #1c7430;
            transform: scale(1.2);
        }

        /* Status Offline */
        .status-indicator.offline {
            background-color: #6c757d;
            border: 2px solid #495057;
            transform: scale(1);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .sidebar.hide {
                width: 70px;
            }

            .main-content.shift {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }

            .main-content {
                margin-left: 180px;
            }

            .sidebar.hide {
                width: 60px;
            }

            .main-content.shift {
                margin-left: 60px;
            }

            header h1 {
                font-size: 14px;
            }

            /* Menyesuaikan ukuran ikon dan teks dalam sidebar pada layar kecil */
            .sidebar .nav-link {
                font-size: 10px;
                padding: 12px 20px;
            }

            .sidebar .nav-link i {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 160px;
            }

            .main-content {
                margin-left: 160px;
            }

            .sidebar.hide {
                width: 50px;
            }

            .main-content.shift {
                margin-left: 50px;
            }

            header h1 {
                font-size: 12px;
            }

            /* Menyesuaikan ukuran ikon dan teks dalam sidebar pada layar sangat kecil */
            .sidebar .nav-link {
                font-size: 10px;
                padding: 12px 15px;
            }

            .sidebar .nav-link i {
                font-size: 18px;
            }
        }

        /* Sembunyikan teks pada sidebar saat hide */
        .sidebar.hide .menu-title {
            display: none;
        }

        /* Tampilkan hanya ikon pada sidebar yang disembunyikan */
        .sidebar.hide .nav-link i {
            font-size: 24px;
            margin-right: 0;
        }

        /* Menu aktif */
        .sidebar .nav-link.active {
            background-color: #0056b3;
            font-weight: bold;
        }

        /* Animasi berdenyut untuk status online */
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Tambahkan animasi ke indikator online */
        .status-indicator.online {
            background-color: #28a745;
            border: 2px solid #1c7430;
            animation: pulse 1.5s infinite;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">

        <div class="mb-4 row">
            <div class="text-center col-8 menu-title">
                <h3>SKLAPP.</h3>
            </div>
            <div class="col-4">
                <!-- Tombol Sidebar -->
                <button id="toggleSidebar" class="ms-4 btn btn-primary">
                    <i class="bi bi-arrow-left-right"></i>
                </button>
            </div>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                    <i class="bi bi-person-square menu-icon"></i>
                    <span class="menu-title">Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('sertifikat.index') ? 'active' : '' }}" href="{{ route('sertifikat.index') }}">
                    <i class="bi bi-file-earmark-text menu-icon"></i>
                    <span class="menu-title">Sertifikat</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Header with Navbar -->
        <header class="navbar navbar-light navbar-glass navbar-top navbar-expand navbar-glass-shadow">

            <!-- Tombol Toggle Sidebar -->
            <!-- <button id="toggleSidebar" class="btn btn-primary">
                <i class="bi bi-arrow-left-right"></i>
            </button> -->

            <!-- Form Pencarian Mahasiswa, geser ke kanan -->
            <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex align-items-center" style="flex-grow: 1; justify-content: flex-end; gap: 5px;">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Mahasiswa" value="{{ request()->query('search') }}" style="max-width: 200px;">
                <!-- <button type="submit" class="btn btn-outline-secondary btn-sm">Cari</button> -->
            </form>

            <!-- Profil dan Dropdown Menu -->
            <div class="profile-dropdown">
                <!-- Status Online / Offline dengan animasi -->
                <span class="me-2 status-indicator online"></span> <!-- Online indicator -->

                <!-- Nama Pengguna -->
                <span class="username" style="font-size: 12px;">{{ Auth::user()->name }}</span>

                <!-- Dropdown Menu untuk Profile dan Logout -->
                <i class="me-2 bi bi-person-circle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="color: #001f54; font-size: 26px;">
                </i>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <!-- Logout -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </header>

        <!-- Content Main -->
        @yield('content')

    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar untuk mobile
        document.getElementById("toggleSidebar").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("hide");
            document.querySelector(".main-content").classList.toggle("shift");
        });
    </script>
</body>

</html>