@php
    /** @var \App\Models\News $item */
    $cardStyle = $cardStyle ?? '';
@endphp
<a href="{{ route('news.show', $item->slug) }}" class="news-card" style="min-width:0;display:flex;flex-direction:column;border:1px solid var(--line);border-radius:14px;overflow:hidden;background:#fff;text-decoration:none;{{ $cardStyle }}">
    <div style="width:100%;aspect-ratio:16/9;flex:0 0 auto;overflow:hidden;display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:0.1em;color:#9aa7b5;
        @if($item->image_path) background:#fff; @else background:repeating-linear-gradient(135deg,#eef2f7,#eef2f7 10px,#f6f9fc 10px,#f6f9fc 20px); @endif">
        @if($item->image_path)
            <img src="{{ asset('storage/'.$item->image_path) }}" alt="" loading="lazy" style="width:100%;height:100%;max-width:100%;max-height:100%;object-fit:cover;display:block;">
        @else
            изображение
        @endif
    </div>
    <div style="padding:24px;display:flex;flex-direction:column;gap:10px;flex:1 1 auto;min-width:0;">
        <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--accent);">{{ $item->published_at?->format('d.m.Y') }}</div>
        <h3 style="font-size:18px;font-weight:600;line-height:1.35;margin:0;color:var(--navy);overflow-wrap:anywhere;">{{ $item->title }}</h3>
        @if($item->excerpt)
            <p style="font-size:14px;line-height:1.55;color:var(--muted);margin:0;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $item->excerpt }}</p>
        @endif
        <span style="margin-top:auto;padding-top:6px;display:inline-flex;align-items:center;gap:7px;font-size:13.5px;font-weight:600;color:var(--accent);">
            Читать
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </span>
    </div>
</a>
