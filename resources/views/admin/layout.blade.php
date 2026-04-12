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
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        :root {
            --sidebar-width: 280px;
            --sidebar-bg: linear-gradient(180deg, #4D869C 0%, #3a6b7d 100%);
            --accent: #4D869C;
            --accent-light: #7AB2B2;
            --bg: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
        }

        body {
            background: var(--bg);
            min-height: 100vh;
            margin: 0;
        }

        /* ===== OVERLAY (mobile) ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1040;
        }
        .sidebar-overlay.show { display: block; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            box-shadow: 4px 0 20px rgba(77,134,156,.2);
            z-index: 1050;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 0 25px 28px;
            border-bottom: 1px solid rgba(255,255,255,.2);
            margin-bottom: 20px;
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            display: flex;
            gap: 12px;
            align-items: center;
            margin: 0;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
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
            font-size: 0.95rem;
        }

        .sidebar-menu a i { font-size: 20px; flex-shrink: 0; }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,.15);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background: #fff;
            color: #4D869C;
            box-shadow: 0 4px 12px rgba(0,0,0,.12);
        }

        /* ===== CONTENT WRAPPER ===== */
        .content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #fff;
            padding: 16px 24px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(77,134,156,.12);
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
            min-width: 0;
        }

        /* Hamburger button */
        .btn-hamburger {
            display: none; /* hidden on desktop */
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            border: 2px solid #E8F4F8;
            background: #F8FBFC;
            color: #4D869C;
            font-size: 22px;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        .btn-hamburger:hover {
            background: #4D869C;
            border-color: #4D869C;
            color: #fff;
        }

        /* User info box */
        .user-info {
            display: flex;
            gap: 12px;
            align-items: center;
            min-width: 0;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 3px solid #CDE8E5;
            flex-shrink: 0;
            object-fit: cover;
        }

        .user-text { min-width: 0; }
        .user-name {
            font-weight: 600;
            color: #4D869C;
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-role {
            font-size: 11px;
            color: #7AB2B2;
            font-weight: 500;
        }

        /* Logout button — FULL label always visible */
        .btn-logout {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239,68,68,.4);
        }

        /* ===== CRUD STYLING ===== */
        .page-header { margin-bottom: 30px; }
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-title i { color: #4D869C; }

        .card-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(77,134,156,.1);
            transition: box-shadow 0.3s ease;
        }
        .card-container:hover { box-shadow: 0 6px 30px rgba(77,134,156,.15); }

        .crud-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 16px;
            flex-wrap: wrap;
        }

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
            white-space: nowrap;
        }
        .btn-add:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(77,134,156,0.3); }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(245,158,11,0.4); }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        .btn-delete:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239,68,68,0.4); }

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

        .table-modern { border-collapse: separate; border-spacing: 0; margin: 0; width: 100%; }
        .table-modern thead th {
            background: linear-gradient(135deg, #4D869C, #7AB2B2);
            color: #fff;
            font-weight: 600;
            padding: 16px 20px;
            border: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table-modern thead th:first-child { border-radius: 12px 0 0 0; }
        .table-modern thead th:last-child  { border-radius: 0 12px 0 0; }

        .table-modern tbody tr { transition: all 0.3s ease; border-bottom: 1px solid #E8F4F8; }
        .table-modern tbody tr:hover { background: #F8FBFC; box-shadow: 0 2px 8px rgba(77,134,156,0.08); }
        .table-modern tbody td { padding: 18px 20px; vertical-align: middle; color: #2c3e50; font-size: 0.95rem; }

        .photo-cell { display: flex; justify-content: center; }
        .user-photo {
            width: 50px; height: 50px;
            border-radius: 12px; object-fit: cover;
            border: 3px solid #CDE8E5;
            transition: transform 0.3s ease;
        }
        .user-photo:hover { transform: scale(1.15); }

        .action-buttons { display: flex; gap: 8px; justify-content: center; }

        .alert-success {
            background: linear-gradient(135deg, #CDE8E5, #EEF7FF);
            border: 2px solid #4D869C;
            border-radius: 12px;
            color: #2c3e50;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .empty-state { text-align: center; padding: 60px 20px; color: #7AB2B2; }
        .empty-state i { font-size: 4rem; margin-bottom: 20px; opacity: 0.5; display: block; }
        .empty-state p { font-size: 1.1rem; font-weight: 500; margin: 0; }

        /* ===== RESPONSIVE ===== */

        /* Tablet & below: sidebar becomes a drawer */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 20px 20px;
            }

            .btn-hamburger {
                display: inline-flex;
            }
        }

        /* Mobile: tighten padding, stack toolbar */
        @media (max-width: 575px) {
            .content { padding: 16px 14px; }

            .navbar-custom { padding: 12px 16px; border-radius: 14px; }

            /* Hide user text on very small screens to save space */
            .user-text { display: none; }

            /* Keep logout fully labelled but shrink padding slightly */
            .btn-logout { padding: 9px 14px; font-size: 0.82rem; }

            .crud-toolbar { flex-direction: column; align-items: stretch; }
            .search-box { max-width: 100%; }
            .action-buttons { flex-direction: column; }

            .page-title { font-size: 1.4rem; }
        }

        /* Very tiny screens: abbreviate logout to icon + text still */
        @media (max-width: 360px) {
            .btn-logout-text { display: none; }
        }
    </style>
</head>

<body>

<!-- OVERLAY (closes sidebar on tap outside) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar" id="sidebar">
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
            <i class="bi bi-diagram-3-fill"></i>
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

<!-- ===== MAIN CONTENT ===== -->
<div class="content" id="mainContent">

    <!-- NAVBAR -->
    <div class="navbar-custom">
        <!-- LEFT: hamburger + user info -->
        <div class="navbar-left">
            <!-- Hamburger (visible on tablet/mobile only via CSS) -->
            <button class="btn-hamburger" id="toggleSidebar" aria-label="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Profile box -->
            <div class="user-info">
                <img class="avatar"
                     src="https://ui-avatars.com/api/?name=Admin&background=4D869C&color=fff"
                     alt="Avatar Admin">
                <div class="user-text">
                    <div class="user-name">{{ auth()->user()->username }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Logout button (always full label) -->
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn-logout">
            <i class="bi bi-box-arrow-right"></i>
            <span class="btn-logout-text">Logout</span>
        </a>
    </div>

    @yield('content')
</div>

<!-- Hidden logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const toggleBtn   = document.getElementById('toggleSidebar');
    const sidebar     = document.getElementById('sidebar');
    const overlay     = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden'; // prevent background scroll
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    // Close when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when a menu link is clicked (mobile UX)
    document.querySelectorAll('.sidebar-menu a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                closeSidebar();
            }
        });
    });

    // Re-open sidebar state on resize (if going back to desktop)
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
})();
</script>

</body>
</html>