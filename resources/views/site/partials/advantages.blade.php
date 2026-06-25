<section id="preimushchestva" style="background:var(--navy);color:#fff;">
    <div style="max-width:1200px;margin:0 auto;padding:88px 32px;">
        <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:#8fb0d4;margin-bottom:14px;">02 — Почему мы</div>
        <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0 0 46px;">Преимущества</h2>
        <div class="grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.12);border-radius:16px;overflow:hidden;">
            @foreach($advantages as $advantage)
                <div style="background:var(--navy);padding:34px 30px;">
                    <div style="font-family:'IBM Plex Mono',monospace;font-size:13px;color:var(--accent);margin-bottom:14px;">— {{ $advantage->number }}</div>
                    <h3 style="font-size:19px;font-weight:600;margin:0 0 9px;">{{ $advantage->title }}</h3>
                    <p style="font-size:14.5px;line-height:1.6;color:#aebfd2;margin:0;">{{ $advantage->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
