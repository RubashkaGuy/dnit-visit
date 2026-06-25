<section style="background:var(--navy);color:#fff;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.04) 1px,transparent 1px);background-size:46px 46px;opacity:0.7;"></div>
    <div class="hero-grid" style="max-width:1200px;margin:0 auto;padding:0 32px;position:relative;display:grid;grid-template-columns:1.15fr 0.85fr;gap:56px;align-items:center;min-height:580px;">
        <div style="padding:80px 0;animation:dnitUp 0.6s ease both;">
            @if($hero->badge_text)
                <div style="display:inline-flex;align-items:center;gap:10px;font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.16em;text-transform:uppercase;color:#a9c4e2;border:1px solid rgba(255,255,255,0.16);padding:7px 14px;border-radius:100px;margin-bottom:30px;">
                    <span style="width:7px;height:7px;border-radius:50%;background:var(--accent);display:inline-block;"></span>
                    {{ $hero->badge_text }}
                </div>
            @endif
            <h1 style="font-size:54px;line-height:1.06;font-weight:700;letter-spacing:-0.025em;margin:0 0 22px;text-wrap:balance;">{!! nl2br(e($hero->headline)) !!}</h1>
            <p style="font-size:18px;line-height:1.6;color:#c5d4e6;max-width:480px;margin:0 0 36px;">{{ $hero->subtitle }}</p>
            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                <a href="{{ $hero->cta_primary_href }}" style="background:var(--accent);color:#fff;font-weight:600;font-size:15.5px;padding:15px 28px;border-radius:9px;">{{ $hero->cta_primary_label }}</a>
                <a href="{{ $hero->cta_secondary_href }}" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.2);color:#fff;font-weight:600;font-size:15.5px;padding:15px 28px;border-radius:9px;">{{ $hero->cta_secondary_label }}</a>
            </div>
        </div>
        <div style="padding:46px 0;">
            <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.13);border-radius:16px;padding:30px;">
                @if($hero->stats_caption)
                    <div style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.16em;text-transform:uppercase;color:#8fb0d4;margin-bottom:20px;">{{ $hero->stats_caption }}</div>
                @endif
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1px;background:rgba(255,255,255,0.1);border-radius:12px;overflow:hidden;">
                    @foreach([1,2,3,4] as $i)
                        @php $v = $hero->{'stat'.$i.'_value'}; $l = $hero->{'stat'.$i.'_label'}; @endphp
                        @if($v || $l)
                            <div style="background:var(--navy);padding:22px 20px;">
                                <div style="font-size:34px;font-weight:700;letter-spacing:-0.02em;">{!! $v !!}</div>
                                <div style="font-size:13px;color:#aebfd2;margin-top:4px;">{{ $l }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if($hero->stats_footer_text)
                    <div style="display:flex;align-items:center;gap:12px;margin-top:18px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);font-size:13px;color:#c5d4e6;">
                        <span style="width:9px;height:9px;border-radius:50%;background:#5bb98c;flex:none;"></span>
                        {{ $hero->stats_footer_text }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
