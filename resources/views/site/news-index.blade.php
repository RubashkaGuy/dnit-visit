<x-site-layout :settings="$settings" :nav-links="$navLinks" page-title="Новости и события — {{ $settings->company_name }}">
    <section style="background:var(--tint);border-bottom:1px solid var(--line);">
        <div style="max-width:1200px;margin:0 auto;padding:64px 32px 56px;">
            <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">Новости</div>
            <h1 style="font-size:46px;font-weight:700;letter-spacing:-0.025em;margin:0 0 14px;color:var(--navy);">Новости и события</h1>
            <p style="font-size:17px;line-height:1.6;color:var(--muted);max-width:680px;margin:0;">Анонсы программ, изменения в законодательстве, события и публикации {{ $settings->company_name }}.</p>
        </div>
    </section>

    <section style="max-width:1200px;margin:0 auto;padding:64px 32px 100px;">
        @if($news->isEmpty())
            <div style="text-align:center;padding:80px 20px;color:var(--muted);">
                <div style="font-size:18px;">Пока нет опубликованных новостей.</div>
            </div>
        @else
            <div class="grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
                @foreach($news as $item)
                    @include('site.partials.news-card', ['item' => $item])
                @endforeach
            </div>

            @if($news->hasPages())
                <div style="margin-top:48px;display:flex;justify-content:center;">
                    {{ $news->onEachSide(1)->links('site.partials.pagination') }}
                </div>
            @endif
        @endif
    </section>
</x-site-layout>
