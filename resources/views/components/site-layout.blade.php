@props([
    'settings',
    'navLinks',
    'pageTitle' => null,
    'pageDescription' => null,
])
@php
    $accent = $settings->accent_color ?: '#2f6db0';
@endphp
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle ?? ($settings->company_name.' — '.$settings->company_short) }}</title>
    @if($pageDescription)
        <meta name="description" content="{{ $pageDescription }}">
    @endif
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{margin:0;font-family:'IBM Plex Sans',system-ui,sans-serif;color:#1b2433;background:#fff;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;}
        :root{--accent:{{ $accent }};--navy:#16304e;--navy2:#1c3a5e;--ink:#1b2433;--muted:#5d6b7e;--line:#e3e9f0;--tint:#f3f6fa;}
        a{color:inherit;text-decoration:none;}
        @keyframes dnitUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}
        .svc-card{transition:box-shadow .2s,transform .2s,border-color .2s;}
        .svc-card:hover{border-color:var(--accent);box-shadow:0 18px 40px -22px rgba(22,48,78,0.4);transform:translateY(-3px);}
        .news-card{transition:box-shadow .2s,transform .2s;}
        .news-card:hover{box-shadow:0 18px 40px -22px rgba(22,48,78,0.35);transform:translateY(-3px);}
        .form-field input,.form-field textarea,.form-field select{transition:border-color .15s;}
        .form-field input:focus,.form-field textarea:focus,.form-field select:focus{border-color:var(--accent);}
        header.scrolled{box-shadow:0 6px 24px -16px rgba(15,34,54,0.45);}
        @media (max-width:900px){
            .hero-grid{grid-template-columns:1fr !important;gap:24px !important;}
            .hero-grid h1{font-size:38px !important;}
            .two-col{grid-template-columns:1fr !important;gap:32px !important;}
            .grid-3{grid-template-columns:1fr !important;}
            .grid-4{grid-template-columns:repeat(2,1fr) !important;}
            .hero-stats-4{grid-template-columns:repeat(2,1fr) !important;}
            header nav{display:none !important;}
            header .header-phone{display:none !important;}
        }
    </style>
    @stack('head')
</head>
<body>
<div style="max-width:100%;overflow-x:hidden;">
    @include('site.partials.header')
    <div id="top"></div>

    {{ $slot }}

    @include('site.partials.footer')
</div>

<script>
    (function(){
        var h=document.querySelector('header');
        if(!h)return;
        function on(){if(window.scrollY>8){h.classList.add('scrolled');}else{h.classList.remove('scrolled');}}
        window.addEventListener('scroll',on,{passive:true});on();
    })();
</script>
@stack('scripts')
</body>
</html>
