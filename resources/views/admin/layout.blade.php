<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            background: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #4D869C 0%, #4D869C 100%);
            height: 100vh;
            position: fixed;
            padding-top: 30px;
            box-shadow: 4px 0 20px rgba(77,134,156,.15);
        }

        .sidebar-brand {
            padding: 0 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,.2);
            margin-bottom: 20px;
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,.25);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            margin: 0 15px 8px;
            color: rgba(255,255,255,.85);
            text-decoration: none;
            border-radius: 12px;
            transition: .3s;
            font-weight: 500;
        }

        .sidebar-menu a i { font-size: 20px; }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,.15);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background: #fff;
            color: #4D869C;
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
        }

        .content {
            margin-left: 280px;
            padding: 30px 40px;
        }

        .navbar-custom {
            background: #fff;
            padding: 18px 40px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(77,134,156,.1);
            margin-bottom: 35px;
        }

        .user-info {
            display: flex;
            gap: 15px;
            align-items: center;
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* ===== CRUD STYLING ===== */
        
        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: #4D869C;
        }

        /* Card Container */
        .card-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(77,134,156,.1);
            transition: box-shadow 0.3s ease;
        }

        .card-container:hover {
            box-shadow: 0 6px 30px rgba(77,134,156,.15);
        }

        /* Toolbar */
        .crud-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn-add {
            background: linear-gradient(135deg, #4D869C, #7AB2B2);
            color: #fff;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-add:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(77,134,156,0.3);
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245,158,11,0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239,68,68,0.4);
        }

        /* Search Box */
        .search-box {
            position: relative;
            width: 100%;
            max-width: 350px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px 12px 48px;
            border: 2px solid #E8F4F8;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #F8FBFC;
        }

        .search-box input:focus {
            outline: none;
            border-color: #4D869C;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(77,134,156,0.1);
        }

        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7AB2B2;
            font-size: 1.1rem;
        }

        /* Table */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }

        .table-modern thead th {
            background: linear-gradient(135deg, #4D869C, #7AB2B2);
            color: #fff;
            font-weight: 600;
            padding: 16px 20px;
            border: none;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-modern thead th:first-child {
            border-radius: 12px 0 0 0;
        }

        .table-modern thead th:last-child {
            border-radius: 0 12px 0 0;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #E8F4F8;
        }

        .table-modern tbody tr:hover {
            background: #F8FBFC;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(77,134,156,0.08);
        }

        .table-modern tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        .table-modern tbody tr:last-child td:first-child {
            border-radius: 0 0 0 12px;
        }

        .table-modern tbody tr:last-child td:last-child {
            border-radius: 0 0 12px 0;
        }

        /* Photo styling */
        .photo-cell {
            display: flex;
            justify-content: center;
        }

        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #CDE8E5;
            transition: transform 0.3s ease;
        }

        .user-photo:hover {
            transform: scale(1.15);
        }

        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        /* Alert styling */
        .alert-success {
            background: linear-gradient(135deg, #CDE8E5, #EEF7FF);
            border: 2px solid #4D869C;
            border-radius: 12px;
            color: #2c3e50;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7AB2B2;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .crud-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
        /* ===== SIDEBAR RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
            }

            .sidebar.active {
                transform: translateX(0);
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
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <span>Admin BK</span>
        </h4>
    </div>

    <div class="sidebar-menu">
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="/admin/konseling" class="{{ request()->is('admin/konseling*') ? 'active' : '' }}">
            <i class="bi bi-chat-dots-fill"></i>
            Data Konseling
        </a>

        <a href="/admin/kelas" class="{{ request()->is('admin/kelas*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Data Kelas
        </a>
        <a href="/admin/siswa" class="{{ request()->is('admin/siswa*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Data Siswa
        </a>

        <a href="/admin/guru" class="{{ request()->is('admin/guru*') ? 'active' : '' }}">
            <i class="bi bi-person-badge-fill"></i>
            Data Guru
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- NAVBAR -->
    <div class="navbar-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <!-- HAMBURGER -->
            <button id="toggleSidebar"
                    class="btn btn-outline-secondary d-md-none">
                <i class="bi bi-list"></i>
            </button>

            <div class="user-info">
                <img class="avatar"
                    src="https://ui-avatars.com/api/?name=Admin&background=4D869C&color=fff">
                <div>
                    <div class="user-name">{{ auth()->user()->username }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
        class="btn-logout">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
    </div>

    @yield('content')
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');

    if (!toggleBtn || !sidebar) {
        console.log('Sidebar / Toggle button not found');
        return;
    }

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('active');
        console.log('Sidebar toggled');
    });
});
</script>


</body>
</html>