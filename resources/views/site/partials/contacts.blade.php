@php
    $phoneDigits = preg_replace('/\D+/', '', $settings->phone ?? '');
@endphp
<section id="kontakty" style="max-width:1200px;margin:0 auto;padding:88px 32px;">
    <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">07 — Контакты</div>
    <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0 0 42px;color:var(--navy);">Как нас найти</h2>
    <div class="two-col" style="display:grid;grid-template-columns:0.8fr 1.2fr;gap:40px;align-items:stretch;">
        <div style="display:flex;flex-direction:column;gap:22px;">
            @if($settings->address_office)
                <div style="border:1px solid var(--line);border-radius:13px;padding:24px;">
                    <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);margin-bottom:9px;">Офис</div>
                    <div style="font-size:16px;font-weight:600;color:var(--navy);line-height:1.5;">{{ $settings->address_office }}</div>
                </div>
            @endif
            @if($settings->address_lab)
                <div style="border:1px solid var(--line);border-radius:13px;padding:24px;">
                    <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);margin-bottom:9px;">Лаборатория</div>
                    <div style="font-size:16px;font-weight:600;color:var(--navy);line-height:1.5;">{{ $settings->address_lab }}</div>
                </div>
            @endif
            <div style="border:1px solid var(--line);border-radius:13px;padding:24px;">
                <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);margin-bottom:9px;">Связь</div>
                @if($settings->phone)
                    <a href="tel:+{{ $phoneDigits }}" style="display:block;font-size:16px;font-weight:600;color:var(--navy);">{{ $settings->phone }}</a>
                @endif
                @if($settings->email)
                    <a href="mailto:{{ $settings->email }}" style="display:block;font-size:15px;color:var(--accent);margin-top:4px;">{{ $settings->email }}</a>
                @endif
            </div>
        </div>
        <div style="border-radius:16px;border:1px solid var(--line);overflow:hidden;min-height:360px;background:repeating-linear-gradient(135deg,#eef2f7,#eef2f7 12px,#f6f9fc 12px,#f6f9fc 24px);position:relative;display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(22,48,78,0.05) 1px,transparent 1px),linear-gradient(90deg,rgba(22,48,78,0.05) 1px,transparent 1px);background-size:40px 40px;"></div>
            <div style="position:relative;text-align:center;background:#fff;border:1px solid var(--line);border-radius:12px;padding:22px 26px;box-shadow:0 14px 40px -22px rgba(22,48,78,0.5);">
                <div style="width:38px;height:38px;border-radius:50%;background:var(--accent);margin:0 auto 12px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">⌖</div>
                <div style="font-weight:600;color:var(--navy);font-size:15px;">{{ Str::limit(preg_replace('/^г\.\s*\S+,\s*/u','', $settings->address_office ?? ''), 30) }}</div>
                <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.1em;color:#9aa7b5;text-transform:uppercase;margin-top:4px;">интерактивная карта</div>
            </div>
        </div>
    </div>
</section>
