@if($trustItems->isNotEmpty())
<section style="background:var(--tint);border-bottom:1px solid var(--line);">
    <div style="max-width:1200px;margin:0 auto;padding:22px 32px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;">
        @foreach($trustItems as $item)
            <div style="display:flex;align-items:center;gap:11px;font-size:14.5px;color:#33414f;"><span style="color:var(--accent);font-weight:700;">✓</span> {{ $item->text }}</div>
        @endforeach
    </div>
</section>
@endif
