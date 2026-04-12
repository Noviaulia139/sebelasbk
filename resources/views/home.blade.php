<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Layanan Konseling Sebelas</title>

  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    section {
      scroll-margin-top: 100px;
    }

    /* =====================
       HEADER
    ===================== */
    #header .topbar {
      background-color: #5A9FB5 !important;
      height: 3px;
    }

    #header .branding {
      background-color: #5A9FB5 !important;
      padding: 16px 0;
    }

    #header .sitename {
      color: #ffffff !important;
      font-size: clamp(16px, 3vw, 26px);
      font-weight: 700;
    }

    #header .navmenu a {
      color: #ffffff !important;
      position: relative;
      font-weight: 500;
      font-size: 15px;
    }

    #header .navmenu a::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #ffffff;
      transition: width 0.3s ease;
    }

    #header .navmenu a:hover::after,
    #header .navmenu a.active::after {
      width: 100%;
    }

    /* =====================
       MOBILE NAV TOGGLE BUTTON
    ===================== */
    .mobile-nav-toggle {
      display: none;
      font-size: 26px;
      color: #ffffff !important;
      cursor: pointer;
      z-index: 9999;
      line-height: 1;
    }

    @media (max-width: 1199px) {
      .mobile-nav-toggle {
        display: block;
      }
    }

    /* =====================
       MOBILE SIDEBAR OVERLAY
    ===================== */
    .mobile-nav-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 9997;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .mobile-nav-overlay.active {
      display: block;
      opacity: 1;
    }

    /* =====================
       MOBILE SIDEBAR PANEL
    ===================== */
    .mobile-sidebar {
      position: fixed;
      top: 0;
      right: -300px;
      width: 280px;
      height: 100%;
      background: #ffffff;
      z-index: 9998;
      box-shadow: -4px 0 30px rgba(0, 0, 0, 0.15);
      transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }

    .mobile-sidebar.active {
      right: 0;
    }

    .mobile-sidebar-header {
      background: linear-gradient(135deg, #5A9FB5 0%, #4D869C 100%);
      padding: 20px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .mobile-sidebar-header .sitename {
      color: #ffffff;
      font-size: 17px;
      font-weight: 700;
    }

    .mobile-sidebar-close {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #ffffff;
      font-size: 20px;
      border: none;
      transition: background 0.2s ease;
      flex-shrink: 0;
    }

    .mobile-sidebar-close:hover {
      background: rgba(255, 255, 255, 0.35);
    }

    .mobile-sidebar-nav {
      padding: 16px 0;
      flex: 1;
    }

    .mobile-sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 15px 24px;
      color: #2c3e50 !important;
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      border-left: 3px solid transparent;
      transition: all 0.2s ease;
    }

    .mobile-sidebar-nav a:hover,
    .mobile-sidebar-nav a.active {
      background: #f0f9fc;
      color: #5A9FB5 !important;
      border-left-color: #5A9FB5;
    }

    .mobile-sidebar-nav a i {
      font-size: 18px;
      color: #5A9FB5;
      width: 22px;
      text-align: center;
    }

    .mobile-sidebar-footer {
      padding: 20px 24px;
      border-top: 1px solid #EEF7FF;
    }

    .mobile-sidebar-footer a {
      display: block;
      text-align: center;
      background: linear-gradient(135deg, #5A9FB5 0%, #4D869C 100%);
      color: #ffffff !important;
      padding: 13px 24px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 15px;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(90, 159, 181, 0.3);
    }

    .mobile-sidebar-footer a:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(90, 159, 181, 0.4);
    }

    /* =====================
       BUTTON
    ===================== */
    .btn-primary {
      background-color: #5A9FB5 !important;
      border: none !important;
      color: #ffffff !important;
      padding: 14px 40px !important;
      border-radius: 30px !important;
      font-weight: 600 !important;
      font-size: 15px !important;
      transition: all 0.3s ease !important;
      box-shadow: 0 4px 15px rgba(90, 159, 181, 0.3) !important;
    }

    .btn-primary:hover {
      background-color: #4D869C !important;
      transform: translateY(-2px) !important;
      box-shadow: 0 6px 20px rgba(90, 159, 181, 0.4) !important;
    }

    /* =====================
       HERO
    ===================== */
    #hero {
      background: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
      padding: 140px 0 100px;
    }

    #hero h1 {
      font-size: clamp(28px, 4.5vw, 52px);
      font-weight: 700;
      color: #2c3e50;
      line-height: 1.2;
      margin-bottom: 25px;
    }

    #hero .highlight {
      color: #5A9FB5 !important;
    }

    #hero .hero-description {
      font-size: clamp(15px, 2vw, 18px);
      color: #7AB2B2;
      line-height: 1.8;
      margin-bottom: 35px;
    }

    #hero .main-image img {
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(90, 159, 181, 0.2);
      width: 100%;
    }

    /* =====================
       TENTANG KAMI
    ===================== */
    #tentang-kami {
      padding: 100px 0;
      background-color: #ffffff;
    }

    #tentang-kami .section-heading {
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: #5A9FB5;
      margin-bottom: 25px;
    }

    #tentang-kami p {
      font-size: clamp(14px, 1.5vw, 17px);
      color: #7AB2B2;
      line-height: 1.9;
    }

    #tentang-kami .about-visual img {
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(90, 159, 181, 0.15);
      width: 100%;
    }

    /* =====================
       GURU
    ===================== */
    #guru {
      background: linear-gradient(135deg, #EEF7FF 0%, #CDE8E5 100%);
      padding: 100px 0;
    }

    #guru .section-title h2 {
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: #5A9FB5;
      margin-bottom: 15px;
    }

    #guru .section-title p {
      font-size: clamp(14px, 1.5vw, 17px);
      color: #7AB2B2;
      margin-bottom: 60px;
    }

    .doctor-card {
      background: #ffffff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(90, 159, 181, 0.12);
      transition: all 0.4s ease;
      height: 100%;
    }

    .doctor-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 50px rgba(90, 159, 181, 0.25);
    }

    .doctor-image {
      position: relative;
      width: 100%;
      padding-top: 100%;
      overflow: hidden;
      background: linear-gradient(135deg, #CDE8E5 0%, #EEF7FF 100%);
    }

    .doctor-image img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 65%;
      height: 65%;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #ffffff;
      box-shadow: 0 8px 25px rgba(90, 159, 181, 0.15);
      transition: all 0.4s ease;
    }

    .doctor-card:hover .doctor-image img {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .doctor-content {
      padding: 28px 20px;
      text-align: center;
    }

    .doctor-content h4 {
      font-size: clamp(14px, 1.5vw, 18px);
      font-weight: 600;
      color: #5A9FB5;
      margin-bottom: 12px;
      line-height: 1.4;
    }

    .doctor-content .specialty {
      display: inline-block;
      color: #ffffff;
      font-size: 13px;
      font-weight: 600;
      background: linear-gradient(135deg, #5A9FB5 0%, #7AB2B2 100%);
      padding: 8px 24px;
      border-radius: 25px;
      box-shadow: 0 4px 15px rgba(90, 159, 181, 0.25);
    }

    /* =====================
       CONTACT
    ===================== */
    #contact {
      padding: 100px 0;
      background-color: #ffffff;
    }

    #contact .section-title h2 {
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: #5A9FB5;
      margin-bottom: 15px;
    }

    #contact .section-title p {
      font-size: clamp(14px, 1.5vw, 17px);
      color: #7AB2B2;
      margin-bottom: 60px;
    }

    .info-item {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 24px;
      box-shadow: 0 8px 30px rgba(90, 159, 181, 0.12);
      height: 100%;
      transition: all 0.4s ease;
      border: 2px solid #EEF7FF;
    }

    .info-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 45px rgba(90, 159, 181, 0.2);
      border-color: #CDE8E5;
    }

    .info-item i {
      font-size: 40px;
      color: #5A9FB5;
      margin-bottom: 18px;
    }

    .info-item h3 {
      font-size: 20px;
      font-weight: 700;
      color: #5A9FB5;
      margin-bottom: 12px;
    }

    .info-item p {
      font-size: 15px;
      color: #7AB2B2;
      margin: 0;
      line-height: 1.7;
    }

    /* =====================
       FAQ
    ===================== */
    #faq {
      padding: 100px 0;
      background: linear-gradient(135deg, #f0f9fc 0%, #e8f5f8 100%);
    }

    #faq .section-title h2 {
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 700;
      color: #5A9FB5;
      margin-bottom: 12px;
    }

    #faq .section-title p {
      font-size: clamp(14px, 1.5vw, 17px);
      color: #7AB2B2;
      margin-bottom: 55px;
    }

    .faq-wrapper {
      max-width: 820px;
      margin: 0 auto;
    }

    .faq-item {
      background: #ffffff;
      border-radius: 20px;
      margin-bottom: 16px;
      box-shadow: 0 4px 20px rgba(90, 159, 181, 0.08);
      border: 1.5px solid #EEF7FF;
      overflow: hidden;
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .faq-item.open {
      border-color: #b0d9e6;
      box-shadow: 0 8px 30px rgba(90, 159, 181, 0.15);
    }

    .faq-question {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 22px 28px;
      cursor: pointer;
      gap: 16px;
      user-select: none;
    }

    .faq-question-left {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .faq-icon-wrap {
      flex-shrink: 0;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: linear-gradient(135deg, #CDE8E5, #EEF7FF);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .faq-icon-wrap i {
      font-size: 18px;
      color: #5A9FB5;
    }

    .faq-question-text {
      font-size: clamp(14px, 1.5vw, 16px);
      font-weight: 600;
      color: #2c3e50;
      line-height: 1.4;
    }

    .faq-toggle {
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #EEF7FF;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .faq-toggle i {
      font-size: 16px;
      color: #5A9FB5;
      transition: transform 0.3s ease;
    }

    .faq-item.open .faq-toggle {
      background: #5A9FB5;
    }

    .faq-item.open .faq-toggle i {
      color: #ffffff;
      transform: rotate(180deg);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, padding 0.3s ease;
      padding: 0 28px 0 84px;
    }

    .faq-item.open .faq-answer {
      max-height: 300px;
      padding: 0 28px 24px 84px;
    }

    .faq-answer p {
      font-size: clamp(13px, 1.4vw, 15px);
      color: #7AB2B2;
      line-height: 1.8;
      margin: 0;
      border-left: 3px solid #CDE8E5;
      padding-left: 16px;
    }

    /* =====================
       FOOTER
    ===================== */
    #footer {
      background: linear-gradient(135deg, #5A9FB5 0%, #4D869C 100%);
      color: #ffffff;
      padding: 70px 0 0;
    }

    #footer .sitename {
      color: #ffffff;
      font-size: clamp(18px, 2.5vw, 24px);
      font-weight: 700;
    }

    #footer .brand-description {
      color: rgba(255,255,255,0.85);
      font-size: 15px;
      line-height: 1.8;
    }

    #footer .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 16px;
      color: rgba(255,255,255,0.9);
      font-size: 15px;
    }

    #footer .contact-item i {
      color: #CDE8E5;
      font-size: 20px;
      margin-top: 2px;
      flex-shrink: 0;
    }

    #footer .nav-column h6 {
      color: #ffffff;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 22px;
    }

    #footer .footer-nav a {
      display: block;
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      font-size: 15px;
      margin-bottom: 12px;
      transition: all 0.3s ease;
    }

    #footer .footer-nav a:hover {
      color: #CDE8E5;
      padding-left: 8px;
    }

    #footer .footer-bottom {
      background: rgba(0,0,0,0.15);
      padding: 22px 0;
      margin-top: 55px;
    }

    #footer .footer-bottom p {
      color: rgba(255,255,255,0.85);
      font-size: 14px;
      margin: 0;
    }

    /* =====================
       SCROLL TOP
    ===================== */
    #scroll-top {
      background-color: #5A9FB5 !important;
      color: #ffffff !important;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: 0 6px 20px rgba(90, 159, 181, 0.35);
      transition: all 0.3s ease;
    }

    #scroll-top:hover {
      background-color: #4D869C !important;
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(90, 159, 181, 0.45);
    }

    /* =====================
       RESPONSIVE
    ===================== */
    @media (max-width: 991px) {
      #hero { padding: 120px 0 80px; }
      #tentang-kami, #guru, #contact, #faq { padding: 80px 0; }
      .doctor-card { margin-bottom: 24px; }
      #hero .col-lg-6:last-child { margin-top: 40px; }
    }

    @media (max-width: 767px) {
      #hero { padding: 100px 0 60px; }
      #tentang-kami, #guru, #contact, #faq { padding: 60px 0; }
      .faq-answer { padding: 0 20px 0 20px; }
      .faq-item.open .faq-answer { padding: 0 20px 20px 20px; }
      .faq-answer p { padding-left: 12px; }
      .faq-question { padding: 18px 20px; }
      .faq-question-left { gap: 12px; }
      .info-item { padding: 30px 20px; }
      .btn-primary { padding: 12px 30px !important; }
    }

    @media (max-width: 480px) {
      .faq-icon-wrap { width: 34px; height: 34px; border-radius: 10px; }
      .faq-icon-wrap i { font-size: 15px; }
      .faq-toggle { width: 30px; height: 30px; }
      .faq-toggle i { font-size: 14px; }
    }

    /* Hide default navmenu on small screens */
    @media (max-width: 1199px) {
      #header .navmenu ul {
        display: none !important;
      }
    }
  </style>
</head>

<body class="index-page">

  <!-- MOBILE SIDEBAR OVERLAY -->
  <div class="mobile-nav-overlay" id="mobileNavOverlay" onclick="closeMobileNav()"></div>

  <!-- MOBILE SIDEBAR PANEL -->
  <div class="mobile-sidebar" id="mobileSidebar">
    <div class="mobile-sidebar-header">
      <span class="sitename">Konseling Sebelas</span>
      <button class="mobile-sidebar-close" onclick="closeMobileNav()" aria-label="Tutup menu">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>

    <nav class="mobile-sidebar-nav">
      <a href="#hero" onclick="closeMobileNav()">
        <i class="bi bi-house-door"></i> Home
      </a>
      <a href="#tentang-kami" onclick="closeMobileNav()">
        <i class="bi bi-info-circle"></i> Tentang Kami
      </a>
      <a href="#guru" onclick="closeMobileNav()">
        <i class="bi bi-people"></i> Guru
      </a>
      <a href="#contact" onclick="closeMobileNav()">
        <i class="bi bi-envelope"></i> Kontak
      </a>
      <a href="#faq" onclick="closeMobileNav()">
        <i class="bi bi-question-circle"></i> FAQ
      </a>
    </nav>

    <div class="mobile-sidebar-footer">
      <a href="{{ route('login') }}" onclick="closeMobileNav()">Login</a>
    </div>
  </div>

  <!-- HEADER -->
  <header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center"></div>
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="#hero" class="logo d-flex align-items-center">
          <h1 class="sitename">Layanan Konseling Sebelas</h1>
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#tentang-kami">Tentang Kami</a></li>
            <li><a href="#guru">Guru</a></li>
            <li><a href="#contact">Kontak</a></li>
          </ul>
          <!-- BURGER BUTTON -->
          <i class="mobile-nav-toggle d-xl-none bi bi-list" id="mobileNavToggle" onclick="openMobileNav()" aria-label="Buka menu"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">

    <!-- HERO -->
    <section id="hero" class="hero section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 data-aos="fade-right" data-aos-delay="300">
                Layanan Bimbingan <span class="highlight">Konseling</span> Digital Untuk Siswa
              </h1>
              <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                Sistem konseling online yang mempermudah siswa membuat janji, berkonsultasi, dan memantau perkembangan.
              </p>
              <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
              <div class="main-image">
                <img src="assets/img/homepict3.jpg" alt="Hero Image" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang-kami" class="home-about section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <div class="about-content">
              <h2 class="section-heading">Tentang Kami</h2>
              <p>
                Bimbingan Konseling SMKN 11 Bandung kini hadir dalam bentuk layanan digital untuk meningkatkan efektivitas dan keterjangkauan pelayanan.
                Sistem ini mempermudah proses konsultasi, pencatatan kasus, penjadwalan, serta komunikasi antara siswa dan guru BK.
                Kami berupaya memberikan layanan terbaik demi mendukung proses pembinaan, pengembangan karakter, serta penyelesaian permasalahan siswa secara profesional.
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="about-visual">
              <img src="assets/img/homepict2.jpeg" alt="About Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- GURU -->
    <section id="guru" class="section">
      <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
          <h2>Guru Bimbingan Konseling</h2>
          <p>Tim profesional yang siap membantu Anda</p>
        </div>
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="100">
            <div class="doctor-card">
              <div class="doctor-image">
                <img src="assets/img/pas_foto_ibu_ameliya.png" class="img-fluid" alt="Suci Nur Fitriyanti">
              </div>
              <div class="doctor-content">
                <h4>Suci Nur Fitriyanti, S.Pd</h4>
                <span class="specialty">Guru BK</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="200">
            <div class="doctor-card">
              <div class="doctor-image">
                <img src="assets/img/pas_foto_ibu_evi.png" class="img-fluid" alt="Evi Febry Damayanti">
              </div>
              <div class="doctor-content">
                <h4>Evi Febry Damayanti, S.Pd</h4>
                <span class="specialty">Guru BK</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="300">
            <div class="doctor-card">
              <div class="doctor-image">
                <img src="assets/img/pas_foto_ibu_wening.png" class="img-fluid" alt="Wening Wigati">
              </div>
              <div class="doctor-content">
                <h4>Dra. Wening Wigati, SE, M.Si</h4>
                <span class="specialty">Guru BK</span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="400">
            <div class="doctor-card">
              <div class="doctor-image">
                <img src="assets/img/pas_foto_ibu_ameliya.png" class="img-fluid" alt="Ameliya Purnama Putri">
              </div>
              <div class="doctor-content">
                <h4>Rr. Ameliya Purnama Putri, S.Pd</h4>
                <span class="specialty">Guru BK</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="section">
      <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
          <h2>Hubungi Kami</h2>
          <p>Kami siap membantu Anda</p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-6 col-md-12">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-geo-alt"></i>
              <h3>Alamat</h3>
              <p>Jl. Raya Cilember, RT.01/RW.04, Sukaraja, Cicendo, Bandung, Jawa Barat 40153</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-telephone"></i>
              <h3>Telepon</h3>
              <p>(022) 6652442</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p>info@smkn11bdg.sch.id</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- FAQ -->
  <section id="faq" class="section">
    <div class="container" data-aos="fade-up">

      <div class="section-title text-center">
        <h2>FAQ (Pertanyaan Umum)</h2>
        <p>Beberapa pertanyaan yang sering ditanyakan siswa</p>
      </div>

      <div class="faq-wrapper">

        <div class="faq-item open">
          <div class="faq-question" onclick="toggleFaq(this)">
            <div class="faq-question-left">
              <div class="faq-icon-wrap">
                <i class="bi bi-chat-dots"></i>
              </div>
              <span class="faq-question-text">Bagaimana cara melakukan konseling?</span>
            </div>
            <div class="faq-toggle">
              <i class="bi bi-chevron-down"></i>
            </div>
          </div>
          <div class="faq-answer">
            <p>Siswa dapat login terlebih dahulu, kemudian memilih menu konseling dan membuat janji dengan guru BK.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            <div class="faq-question-left">
              <div class="faq-icon-wrap">
                <i class="bi bi-shield-lock"></i>
              </div>
              <span class="faq-question-text">Apakah konseling bersifat rahasia?</span>
            </div>
            <div class="faq-toggle">
              <i class="bi bi-chevron-down"></i>
            </div>
          </div>
          <div class="faq-answer">
            <p>Ya, semua data dan percakapan konseling dijaga kerahasiaannya oleh guru BK.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFaq(this)">
            <div class="faq-question-left">
              <div class="faq-icon-wrap">
                <i class="bi bi-person-check"></i>
              </div>
              <span class="faq-question-text">Apakah bisa memilih guru BK?</span>
            </div>
            <div class="faq-toggle">
              <i class="bi bi-chevron-down"></i>
            </div>
          </div>
          <div class="faq-answer">
            <p>Tidak, siswa tidak dapat memilih guru BK. Guru BK akan ditentukan oleh sistem.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer id="footer" class="footer-16 footer position-relative">
    <div class="container">
      <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-start gy-4">
          <div class="col-lg-5 col-md-12">
            <div class="brand-section">
              <a href="#hero" class="logo d-flex align-items-center mb-4">
                <span class="sitename">Layanan Konseling Sebelas</span>
              </a>
              <p class="brand-description">
                Layanan Bimbingan Konseling digital yang membantu siswa mendapatkan pendampingan secara mudah dan profesional.
              </p>
              <div class="contact-info mt-4">
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span>Jl. Raya Cilember, RT.01/RW.04, Sukaraja, Cicendo, Bandung, Jawa Barat 40153</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>(022) 6652442</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-12">
            <div class="footer-nav-wrapper">
              <div class="row gy-4">
                <div class="col-6">
                  <div class="nav-column">
                    <h6>Navigasi</h6>
                    <nav class="footer-nav">
                      <a href="#tentang-kami">Tentang Kami</a>
                      <a href="#guru">Guru</a>
                      <a href="#contact">Kontak</a>
                    </nav>
                  </div>
                </div>
                <div class="col-6">
                  <div class="nav-column">
                    <h6>Bantuan</h6>
                    <nav class="footer-nav">
                      <a href="#faq">FAQ</a>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="bottom-content d-flex justify-content-between align-items-center flex-wrap gap-2">
          <p>© 2025 Layanan Konseling Sebelas</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="assets/js/main.js"></script>

  <script>
    /* =====================
       MOBILE SIDEBAR
    ===================== */
    function openMobileNav() {
      document.getElementById('mobileSidebar').classList.add('active');
      document.getElementById('mobileNavOverlay').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMobileNav() {
      document.getElementById('mobileSidebar').classList.remove('active');
      document.getElementById('mobileNavOverlay').classList.remove('active');
      document.body.style.overflow = '';
    }

    // Tutup sidebar saat tekan ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeMobileNav();
    });

    /* =====================
       FAQ TOGGLE
    ===================== */
    function toggleFaq(btn) {
      const item = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    }

    /* =====================
       SMOOTH SCROLL + ACTIVE NAV
    ===================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          document.querySelectorAll('.navmenu a, .mobile-sidebar-nav a').forEach(l => l.classList.remove('active'));
          this.classList.add('active');
        }
      });
    });

    /* =====================
       SCROLL ACTIVE STATE
    ===================== */
    window.addEventListener('scroll', () => {
      let current = '';
      document.querySelectorAll('section[id]').forEach(section => {
        if (pageYOffset >= section.offsetTop - 150) current = section.getAttribute('id');
      });
      document.querySelectorAll('.navmenu a, .mobile-sidebar-nav a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) link.classList.add('active');
      });
    });
  </script>

</body>
</html>