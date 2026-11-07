<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#211719">
    <title>@yield('title', 'Katalog Film') · Layar Kota</title>
    <link rel="icon" type="image/png" href="{{ asset('brand/layar-kota-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/cinema.css') }}">
    @stack('scripts')
</head>
<body class="@yield('body-class')">
    <a class="skip-link" href="#main">Lewati ke konten</a>
    <header class="site-header">
        <div class="shell header-inner">
            <a class="brand" href="{{ route('catalog') }}">
                <img class="brand-icon" src="{{ asset('brand/layar-kota-icon.png') }}" width="36" height="36" alt="">
                Layar Kota<span class="brand-period">.</span>
            </a>
            <nav aria-label="Navigasi utama">
                <a href="{{ route('catalog') }}#film" @if(request()->routeIs('catalog')) aria-current="page" @endif>Katalog film</a>
            </nav>
        </div>
    </header>

    <main id="main" tabindex="-1">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="shell footer-inner">
            <a class="brand" href="{{ route('catalog') }}">
                <img class="brand-icon" src="{{ asset('brand/layar-kota-icon.png') }}" width="36" height="36" alt="">
                Layar Kota<span class="brand-period">.</span>
            </a>
            <span>Simulasi pemesanan tiket bioskop</span>
        </div>
    </footer>
</body>
</html>
