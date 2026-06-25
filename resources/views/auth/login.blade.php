<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login · {{ config('sim-klinik.name') }}</title>
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}?v={{ @filemtime(public_path('assets/css/login.css')) }}">
</head>
<body class="login-page">
<div class="login-split">
  <section class="login-brand">
    <span class="lb-badge">{!! app_icon('shield') !!} Sistem Informasi Manajemen Klinik</span>
    <h1 class="lb-title">Pelayanan Klinik yang<br>Cepat, Aman, dan<br>Terintegrasi</h1>
    <p class="lb-sub">
      SIM Klinik menghadirkan sistem manajemen klinik terintegrasi untuk registrasi
      pasien, pemeriksaan, farmasi, hingga pembayaran secara cepat, akurat, dan profesional.
    </p>
    <div class="lb-foot">
      <div class="lb-foot-name">{{ $clinicName }}<small>{{ $clinicUnit }}</small></div>
      <span class="lb-secure">{!! app_icon('shield') !!} Akses Aman Aktif</span>
    </div>
  </section>

  <section class="login-form-side">
    <div class="login-card">
      <div class="lc-logo">
        <div class="lc-logo-name">SIM <span>Klinik</span></div>
        <div class="lc-logo-sub">{{ config('sim-klinik.full') }}</div>
      </div>

      <h2 class="lc-welcome">Selamat Datang</h2>
      <p class="lc-welcome-sub">Silakan login untuk mengakses SIM Klinik<br>secara aman dan profesional.</p>

      @if($errors->any())
        <div class="lc-alert">{{ $errors->first() }}</div>
      @endif

      <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="lc-field">
          <label>Username</label>
          <div class="lc-input">
            {!! app_icon('user') !!}
            <input type="text" name="username" placeholder="Masukkan username" autofocus
                   value="{{ old('username') }}">
          </div>
        </div>

        <div class="lc-field">
          <label>Password</label>
          <div class="lc-input">
            {!! app_icon('shield') !!}
            <input type="password" name="password" id="pwd" placeholder="Masukkan password">
            <button type="button" class="lc-eye" onclick="togglePwd(this)" aria-label="Tampilkan/sembunyikan password">{!! app_icon('eye') !!}</button>
          </div>
        </div>

        <button type="submit" class="lc-btn">{!! app_icon('logout') !!} Login ke Sistem</button>
      </form>

      <div class="lc-foot">
        &copy; {{ date('Y') }} <b>{{ config('sim-klinik.name') }}</b><br>
        Dikelola oleh {{ $clinicName }}
      </div>
    </div>
  </section>
</div>
<script>
function togglePwd(btn){
  var i = document.getElementById('pwd');
  i.type = i.type === 'password' ? 'text' : 'password';
  btn.style.color = i.type === 'text' ? '#2563eb' : '';
}
</script>
</body>
</html>
