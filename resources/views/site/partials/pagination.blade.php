@if ($paginator->hasPages())
    <nav style="display:flex;gap:8px;align-items:center;font-family:'IBM Plex Sans',sans-serif;">
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--line);color:#aab4c2;font-size:14px;font-weight:500;background:#fff;">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--line);color:var(--navy);font-size:14px;font-weight:500;background:#fff;">←</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 12px;color:var(--muted);font-size:14px;">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--accent);background:var(--accent);color:#fff;font-size:14px;font-weight:600;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--line);color:var(--navy);font-size:14px;font-weight:500;background:#fff;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--line);color:var(--navy);font-size:14px;font-weight:500;background:#fff;">→</a>
        @else
            <span style="display:inline-flex;align-items:center;justify-content:center;min-width:42px;height:42px;padding:0 14px;border-radius:9px;border:1px solid var(--line);color:#aab4c2;font-size:14px;font-weight:500;background:#fff;">→</span>
        @endif
    </nav>
@endif
