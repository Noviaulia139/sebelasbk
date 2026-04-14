<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - BK Sebelas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
font-family:'Inter',sans-serif;
}

body{
min-height:100vh;
background:linear-gradient(135deg,#CDE8E5 0%,#EEF7FF 100%);
display:flex;
align-items:center;
justify-content:center;
padding:20px;
}

.login-card{
width:100%;
max-width:420px;
background:#fff;
border-radius:24px;
padding:40px 35px;
box-shadow:0 12px 40px rgba(77,134,156,0.18);
border:1px solid rgba(122,178,178,0.25);
}

.logo-circle{
width:75px;
height:75px;
background:linear-gradient(135deg,#4D869C,#7AB2B2);
border-radius:20px;
display:flex;
align-items:center;
justify-content:center;
color:#fff;
font-size:34px;
margin:0 auto 20px;
}

h3{
text-align:center;
font-weight:700;
font-size:26px;
color:#4D869C;
margin-bottom:10px;
}

.subtitle{
text-align:center;
color:#7AB2B2;
font-size:14px;
margin-bottom:30px;
}

.form-control{
height:48px;
border-radius:12px;
border:1px solid #CDE8E5;
}

.form-control:focus{
border-color:#7AB2B2;
box-shadow:0 0 0 3px rgba(122,178,178,0.25);
}

.btn-login{
background:linear-gradient(135deg,#4D869C,#7AB2B2);
color:#fff;
font-weight:600;
border-radius:12px;
border:none;
width:100%;
height:48px;
margin-top:10px;
}

.footer-text{
margin-top:25px;
text-align:center;
font-size:12px;
color:#7AB2B2;
}

</style>
</head>

<body>

{{-- Jika sudah login → redirect --}}
@if(Auth::check())
<script>
    alert("Anda sudah login, silakan logout terlebih dahulu!");
    window.location.href = "/";
</script>
@endif

<div class="login-card">

<div class="logo-circle">
<i class="bi bi-mortarboard-fill"></i>
</div>

<h3>Login Sistem BK</h3>
<p class="subtitle">Masuk menggunakan akun Anda</p>

@if(session('error'))
<div class="alert alert-danger py-2">
{{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger py-2">
{{ $errors->first() }}
</div>
@endif

<form action="{{ route('login.process') }}" method="POST">
@csrf

<div class="mb-3">
<label class="form-label text-muted">Username / NIP / NISN</label>
<input 
type="text"
class="form-control"
name="username"
value="{{ old('username') }}"
required>
</div>

<div class="mb-3">
<label class="form-label text-muted">Password</label>
<input 
type="password"
class="form-control"
name="password"
required>
</div>

<button type="submit" class="btn-login">
<i class="bi bi-box-arrow-in-right me-2"></i>Masuk
</button>

</form>

<p class="footer-text">BK SMKN 11 Bandung — {{ date('Y') }}</p>

</div>

</body>
</html>