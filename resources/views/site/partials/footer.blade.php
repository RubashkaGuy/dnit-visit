@php
    $phoneDigits = preg_replace('/\D+/', '', $settings->phone ?? '');
    $onHome = request()->routeIs('home');
    $navHref = fn($href) => (!$onHome && str_starts_with($href, '#')) ? route('home') . $href : $href;
@endphp
<footer style="background:#0f2236;color:#cdd9e6;">
    <div style="max-width:1200px;margin:0 auto;padding:54px 32px 30px;">
        <div class="grid-3" style="display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:40px;padding-bottom:38px;border-bottom:1px solid rgba(255,255,255,0.1);">
            <div>
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                    <span style="width:44px;height:44px;border-radius:8px;background:#fff;display:flex;align-items:center;justify-content:center;padding:5px;">
                        <img src="{{ asset('storage/images/logo.png') }}" alt="{{ $settings->company_name }}" style="max-width:100%;max-height:100%;object-fit:contain;display:block;">
                    </span>
                    <span style="font-weight:700;font-size:16px;color:#fff;">{{ $settings->company_name }}</span>
                </div>
                <p style="font-size:13.5px;line-height:1.65;color:#8ea2b8;margin:0;max-width:320px;">{{ $settings->footer_about }}</p>
            </div>
            <div>
                <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#6f8298;margin-bottom:14px;">Разделы</div>
                <div style="display:flex;flex-direction:column;gap:9px;font-size:14px;">
                    @foreach($navLinks as $link)
                        <a href="{{ $navHref($link->href) }}">{{ $link->label }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#6f8298;margin-bottom:14px;">Контакты</div>
                <div style="display:flex;flex-direction:column;gap:9px;font-size:14px;">
                    @if($settings->phone)<a href="tel:+{{ $phoneDigits }}">{{ $settings->phone }}</a>@endif
                    @if($settings->email)<a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>@endif
                    @if($settings->address_office)<span style="color:#8ea2b8;">{{ $settings->address_office }}</span>@endif
                </div>
            </div>
        </div>
        <div style="display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;padding-top:24px;font-size:12.5px;color:#6f8298;font-family:'IBM Plex Mono',monospace;letter-spacing:0.04em;">
            <span>{{ $settings->footer_copyright }}</span>
            <span>@if($settings->inn)ИНН {{ $settings->inn }}@endif @if($settings->ogrn) · ОГРН {{ $settings->ogrn }}@endif</span>
        </div>
    </div>
</footer>
