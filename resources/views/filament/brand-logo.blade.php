@php
    $settings = \App\Models\SiteSetting::current();
@endphp
<div style="display:flex;align-items:center;gap:10px;">
    <img src="{{ asset('storage/images/logo.png') }}" alt="ДНИТ" style="height:2.2rem;width:2.2rem;object-fit:contain;display:block;">
    <div style="display:flex;flex-direction:column;line-height:1.05;">
        <span style="font-weight:700;font-size:0.95rem;letter-spacing:-0.01em;color:rgb(var(--gray-900));">ДНИТ</span>
        <span style="font-family:'IBM Plex Mono',ui-monospace,monospace;font-size:0.65rem;letter-spacing:0.12em;color:rgb(var(--gray-500));text-transform:uppercase;">Панель</span>
    </div>
</div>
