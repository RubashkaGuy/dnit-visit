@php
    $phoneDigits = preg_replace('/\D+/', '', $settings->phone ?? '');
    $onHome = request()->routeIs('home');
    $navHref = fn($href) => (!$onHome && str_starts_with($href, '#')) ? route('home') . $href : $href;
@endphp
<header style="position:sticky;top:0;z-index:50;background:rgba(255,255,255,0.94);backdrop-filter:saturate(140%) blur(8px);border-bottom:1px solid var(--line);">
    <div style="max-width:1200px;margin:0 auto;padding:12px 24px;min-height:74px;display:flex;align-items:center;gap:18px;">
        <a href="{{ route('home') }}#top" style="display:flex;align-items:center;gap:13px;flex:none;">
            <img src="{{ asset('storage/images/logo.png') }}" alt="{{ $settings->company_name }}" style="width:48px;height:48px;flex:none;object-fit:contain;display:block;">
            <span style="display:flex;flex-direction:column;line-height:1.05;">
                <span style="font-weight:700;font-size:16px;letter-spacing:-0.01em;color:var(--navy);">{{ $settings->company_name }}</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:10.5px;letter-spacing:0.14em;color:var(--muted);text-transform:uppercase;">{{ $settings->company_short }}</span>
            </span>
        </a>
        <nav style="margin-left:auto;display:flex;align-items:center;gap:20px;flex-wrap:wrap;justify-content:flex-end;min-width:0;">
            @foreach($navLinks as $link)
                <a href="{{ $navHref($link->href) }}" style="font-size:14px;font-weight:500;color:#33414f;white-space:nowrap;">{{ $link->label }}</a>
            @endforeach
        </nav>
        @if($settings->phone)
            <a href="tel:+{{ $phoneDigits }}" class="header-phone" style="display:flex;flex-direction:column;align-items:flex-end;line-height:1.1;flex:none;">
                <span style="font-weight:700;font-size:16px;color:var(--navy);letter-spacing:0.01em;">{{ $settings->phone }}</span>
                <span style="font-family:'IBM Plex Mono',monospace;font-size:10px;letter-spacing:0.1em;color:var(--muted);text-transform:uppercase;">{{ $settings->phone_hours }}</span>
            </a>
        @endif
        <a href="{{ $navHref('#zayavka') }}" style="flex:none;background:var(--accent);color:#fff;font-weight:600;font-size:14px;padding:11px 20px;border-radius:8px;">Оставить заявку</a>
    </div>
</header>
