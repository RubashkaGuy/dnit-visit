<section id="o-kompanii" class="two-col" style="max-width:1200px;margin:0 auto;padding:88px 32px;display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;">
    <div>
        <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">{{ $about->eyebrow }}</div>
        <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0 0 22px;color:var(--navy);">{!! nl2br(e($about->headline)) !!}</h2>
        @foreach(preg_split("/\r?\n\r?\n/", trim($about->body ?? '')) as $p)
            @if(trim($p) !== '')
                <p style="font-size:16.5px;line-height:1.7;color:#3a4757;margin:0 0 18px;">{{ $p }}</p>
            @endif
        @endforeach
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;border-top:1px solid var(--line);padding-top:28px;margin-top:12px;">
            @foreach([1,2,3] as $i)
                @php $v = $about->{'stat'.$i.'_value'}; $l = $about->{'stat'.$i.'_label'}; @endphp
                @if($v || $l)
                    <div>
                        <div style="font-size:34px;font-weight:700;color:var(--navy);letter-spacing:-0.02em;">{{ $v }}</div>
                        <div style="font-size:13px;color:var(--muted);margin-top:4px;">{{ $l }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div style="aspect-ratio:4/3;border-radius:16px;border:1px solid var(--line);overflow:hidden;position:relative;display:flex;align-items:center;justify-content:center;
        @if($about->photo_path) background:#000; @else background:repeating-linear-gradient(135deg,#eef2f7,#eef2f7 11px,#f6f9fc 11px,#f6f9fc 22px); @endif">
        @if($about->photo_path)
            <img src="{{ asset('storage/'.$about->photo_path) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
        @else
            <div style="text-align:center;">
                <div style="width:60px;height:60px;border-radius:14px;background:var(--navy);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:'IBM Plex Mono',monospace;font-weight:600;">{{ $settings->logo_text_left }}{{ $settings->logo_text_right }}</div>
                <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.12em;color:#7d8b9b;text-transform:uppercase;">фото · учебный центр / лаборатория</div>
            </div>
        @endif
    </div>
</section>
