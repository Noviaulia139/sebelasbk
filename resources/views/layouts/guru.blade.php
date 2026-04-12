@php
    $guru = Auth::user()->guru;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            background: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #4D869C 0%, #4D869C 100%);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            z-index: 1000;
            transition: 0.3s;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }

        /* OVERLAY */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            display: none;
            z-index: 999;
        }

        #overlay.show {
            display: block;
        }

        .sidebar-brand {
            padding: 0 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            font-size: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.25);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-menu {
            padding: 0 15px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .sidebar-menu a.active {
            background: #fff;
            color: #4D869C;
        }

        /* CONTENT */
        .content {
            margin-left: 280px;
            padding: 30px 40px;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 20px;
            }
        }

        /* NAVBAR */
        .navbar-custom {
            background: #fff;
            padding: 18px 40px;
            border-radius: 20px;
            margin-bottom: 35px;
        }

        .hamburger {
            font-size: 24px;
            border: none;
            background: transparent;
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            border: 3px solid #CDE8E5;
        }

        .user-name {
            font-weight: 600;
            color: #4D869C;
        }

        .user-role {
            font-size: 12px;
            color: #7AB2B2;
        }

        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<!-- OVERLAY -->
<div id="overlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4>
            <div class="icon-box">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span>Guru BK</span>
        </h4>
    </div>

    <div class="sidebar-menu">
        <a href="/guru/dashboard" class="{{ request()->is('guru/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="/guru/konseling" class="{{ request()->is('guru/konseling*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots-fill"></i> Konseling Masuk
        </a>
        <a href="/guru/riwayat" class="{{ request()->is('guru/riwayat*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Konseling
        </a>
        <a href="/guru/profil" class="{{ request()->is('guru/profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i> Profil Saya
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- NAVBAR -->
    <div class="navbar-custom">
        <div class="d-flex justify-content-between align-items-center">

            <!-- BURGER -->
            <button id="toggleSidebar" class="hamburger">
                <i class="bi bi-list"></i>
            </button>

            <!-- USER INFO (KONSISTEN SAMA SISWA) -->
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama ?? 'Guru') }}&background=4D869C&color=fff&bold=true" class="avatar">
                <div>
                    <div class="user-name">{{ $guru->nama ?? 'Guru BK' }}</div>
                    <div class="user-role">Guru bimbingan konseling</div>
                </div>
            </div>

            <!-- LOGOUT (TIDAK DIUBAH) -->
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn-logout">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        </div>
    </div>

    @yield('content')

</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script>
    const btn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    btn.addEventListener("click", function () {
        sidebar.classList.toggle("show");
        overlay.classList.toggle("show");
    });

    overlay.addEventListener("click", function () {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>