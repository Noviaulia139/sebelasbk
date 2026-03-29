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
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #4D869C 0%, #4D869C 100%);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 4px 0 20px rgba(77, 134, 156, 0.15);
            z-index: 1000;
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
            color: #4D869C;
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
        
        .navbar-custom {
            background: #fff;
            box-shadow: 0 4px 20px rgba(77, 134, 156, 0.1);
            padding: 18px 40px;
            border-radius: 20px;
            margin-bottom: 35px;
            border: 1px solid rgba(122, 178, 178, 0.2);
        }
        
        .navbar-custom .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .navbar-custom .user-name {
            font-weight: 600;
            color: #4D869C;
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
        
        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #4D869C;
            margin-bottom: 25px;
            text-shadow: 0 2px 4px rgba(77, 134, 156, 0.1);
        }
        
        .stat-card {
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid rgba(122, 178, 178, 0.2);
            box-shadow: 0 8px 30px rgba(77, 134, 156, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(77, 134, 156, 0.15);
            border-color: #7AB2B2;
        }
        
        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 18px;
        }
        
        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }
        
        .stat-card.primary .stat-icon {
            background: linear-gradient(135deg, #7AB2B2 0%, #4D869C 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(122, 178, 178, 0.3);
        }
        
        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .stat-card h6 {
            color: #7AB2B2;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card h3 {
            font-size: 36px;
            font-weight: 700;
            color: #4D869C;
            margin: 0;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #4D869C;
            margin-top: 45px;
            margin-bottom: 20px;
        }
        
        .table-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(122, 178, 178, 0.2);
            box-shadow: 0 8px 30px rgba(77, 134, 156, 0.08);
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background: linear-gradient(135deg, #4D869C 0%, #7AB2B2 100%);
        }
        
        .table thead th {
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 24px;
            border: none;
        }
        
        .table tbody td {
            padding: 18px 24px;
            vertical-align: middle;
            color: #4D869C;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid #CDE8E5;
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .table tbody tr:hover {
            background: #EEF7FF;
        }
        
        .badge {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.3px;
        }
        
        .btn-action {
            background: linear-gradient(135deg, #4D869C 0%, #7AB2B2 100%);
            color: #fff;
            border: none;
            padding: 9px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(77, 134, 156, 0.25);
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(77, 134, 156, 0.35);
            color: #fff;
        }
        
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #7AB2B2;
        }
        
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.4;
            color: #7AB2B2;
        }
        
        .empty-state h5 {
            color: #4D869C;
            font-weight: 600;
        }
        
        .empty-state p {
            color: #7AB2B2;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
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
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="/guru/konseling" class="{{ request()->is('guru/konseling*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots-fill"></i>
                <span>Konseling Masuk</span>
            </a>
            <a href="/guru/riwayat" class="{{ request()->is('guru/riwayat*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat Konseling</span>
            </a>
            <a href="/guru/profil" class="{{ request()->is('guru/profil') ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i>
                <span>Profil Saya</span>
            </a>
        </div>
    </div>
    
    <!-- CONTENT -->
    <div class="content">
        <!-- NAVBAR -->
        <div class="navbar-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Guru+BK&background=4D869C&color=fff&bold=true" class="avatar">
                    <div>
                        <div class="user-name">{{ auth()->user()->nama ?? 'Guru BK' }}</div>
                        <div class="user-role">Guru Bimbingan Konseling</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>