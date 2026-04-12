@php
    $siswa = Auth::user()->siswa;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }}</title>

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
            background-attachment: fixed;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #5A9FB5 0%, #4D869C 100%);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 4px 0 20px rgba(90, 159, 181, 0.15);
            z-index: 1000;
            transition: 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            .sidebar.show {
                left: 0;
            }
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
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar-brand .icon-box {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.25);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        
        .sidebar-menu { padding: 0 15px; }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .sidebar-menu a i {
            font-size: 20px;
            width: 24px;
        }
        
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateX(5px);
        }
        
        .sidebar-menu a.active {
            background: #fff;
            color: #5A9FB5;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 70%;
            background: #7AB2B2;
            border-radius: 0 4px 4px 0;
        }
        
        .content {
            margin-left: 280px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
        
        .navbar-custom {
            background: #fff;
            box-shadow: 0 4px 20px rgba(90, 159, 181, 0.1);
            padding: 18px 40px;
            border-radius: 20px;
            margin-bottom: 35px;
            border: 1px solid rgba(205, 232, 229, 0.5);
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
        
        .navbar-custom .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .navbar-custom .user-name {
            font-weight: 600;
            color: #5A9FB5;
            font-size: 15px;
        }
        
        .navbar-custom .user-role {
            font-size: 12px;
            color: #7AB2B2;
            font-weight: 500;
        }
        
        .navbar-custom .avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            border: 3px solid #CDE8E5;
            object-fit: cover;
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239,68,68,0.25);
        }
        
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239,68,68,0.35);
            color: #fff;
        }

        /* 🔥 OVERLAY */
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
    </style>
</head>

<body>

<!-- 🔥 OVERLAY -->
<div id="overlay"></div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-brand">
        <h4>
            <div class="icon-box">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span>Siswa</span>
        </h4>
    </div>
    <div class="sidebar-menu">
        <a href="/siswa/dashboard" class="{{ request()->is('siswa/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="/siswa/konseling/ajukan" class="{{ request()->is('siswa/konseling/ajukan') ? 'active' : '' }}">
            <i class="bi bi-chat-right-text-fill"></i>
            <span>Ajukan Konseling</span>
        </a>
        <a href="/siswa/riwayat" class="{{ request()->is('siswa/riwayat*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat Konseling</span>
        </a>
        <a href="/siswa/profil" class="{{ request()->is('siswa/profil') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil Saya</span>
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="navbar-custom">
        <div class="d-flex justify-content-between align-items-center">

            <!-- 🔥 BURGER -->
            <button id="toggleSidebar" class="hamburger">
                <i class="bi bi-list"></i>
            </button>

            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->nama ?? 'Siswa') }}&background=5A9FB5&color=fff&bold=true" class="avatar">
                <div>
                    <div class="user-name">{{ $siswa->nama ?? 'Siswa' }}</div>
                    <div class="user-role">Siswa SMKN 11 Bandung</div>
                </div>
            </div>

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

<!-- 🔥 SCRIPT FIX -->
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