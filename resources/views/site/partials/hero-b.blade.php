<section style="background:var(--navy);color:#fff;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 80% 20%, rgba(47,109,176,0.35), transparent 55%);"></div>
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.045) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.045) 1px,transparent 1px);background-size:54px 54px;"></div>
    <div style="max-width:1000px;margin:0 auto;padding:96px 32px 84px;position:relative;text-align:center;animation:dnitUp 0.6s ease both;">
        @if($hero->badge_text)
            <div style="display:inline-flex;align-items:center;gap:10px;font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.16em;text-transform:uppercase;color:#a9c4e2;border:1px solid rgba(255,255,255,0.16);padding:7px 16px;border-radius:100px;margin-bottom:30px;">{{ $hero->badge_text }}</div>
        @endif
        <h1 style="font-size:60px;line-height:1.05;font-weight:700;letter-spacing:-0.03em;margin:0 auto 24px;max-width:880px;text-wrap:balance;">{!! nl2br(e($hero->headline)) !!}</h1>
        <p style="font-size:19px;line-height:1.6;color:#c5d4e6;max-width:600px;margin:0 auto 38px;">{{ $hero->subtitle }}</p>
        <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;margin-bottom:54px;">
            <a href="{{ $hero->cta_primary_href }}" style="background:var(--accent);color:#fff;font-weight:600;font-size:15.5px;padding:15px 30px;border-radius:9px;">{{ $hero->cta_primary_label }}</a>
            <a href="{{ $hero->cta_secondary_href }}" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.2);color:#fff;font-weight:600;font-size:15.5px;padding:15px 30px;border-radius:9px;">{{ $hero->cta_secondary_label }}</a>
        </div>
        <div class="hero-stats-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.12);border-radius:14px;overflow:hidden;max-width:760px;margin:0 auto;">
            @foreach([1,2,3,4] as $i)
                @php $v = $hero->{'stat'.$i.'_value'}; $l = $hero->{'stat'.$i.'_label'}; @endphp
                @if($v || $l)
                    <div style="background:var(--navy);padding:24px 16px;">
                        <div style="font-size:32px;font-weight:700;">{!! $v !!}</div>
                        <div style="font-size:12.5px;color:#aebfd2;margin-top:4px;">{{ $l }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
