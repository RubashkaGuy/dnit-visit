<section id="uslugi" style="max-width:1200px;margin:0 auto;padding:88px 32px;">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;margin-bottom:46px;flex-wrap:wrap;">
        <div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">01 — Направления</div>
            <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0;color:var(--navy);">Услуги</h2>
        </div>
        <p style="font-size:16px;color:var(--muted);max-width:420px;margin:0;">Полный цикл услуг по обучению, охране труда, оценке условий труда и экологии для предприятий любого масштаба.</p>
    </div>
    <div class="grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;">
        @foreach($services as $service)
            <div class="svc-card" style="border:1px solid var(--line);border-radius:14px;padding:30px;background:#fff;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:22px;">
                    <span style="width:50px;height:50px;border-radius:11px;background:var(--tint);color:var(--accent);display:flex;align-items:center;justify-content:center;">
                        {!! $service->icon_svg !!}
                    </span>
                    <span style="font-family:'IBM Plex Mono',monospace;font-size:13px;color:#aab6c4;">{{ $service->number }}</span>
                </div>
                <h3 style="font-size:19px;font-weight:600;margin:0 0 10px;color:var(--navy);">{{ $service->title }}</h3>
                <p style="font-size:14.5px;line-height:1.6;color:var(--muted);margin:0;">{{ $service->description }}</p>
            </div>
        @endforeach
    </div>
</section>
