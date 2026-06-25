@php
    $months = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
    $dt = $item->published_at;
    $dateStr = $dt ? $dt->day.' '.$months[$dt->month - 1].' '.$dt->year : '';

    $ctaEnabled = (bool) ($settings->news_cta_enabled ?? false);
    $ctaLabel = $settings->news_cta_label ?: 'Оставить заявку';
    $ctaHrefRaw = $settings->news_cta_href ?: '/#zayavka';
    if (str_starts_with($ctaHrefRaw, '#')) {
        $ctaHref = route('home') . $ctaHrefRaw;
    } else {
        $ctaHref = $ctaHrefRaw;
    }
    $ctaNewTab = (bool) ($settings->news_cta_new_tab ?? false);
@endphp
<x-site-layout
    :settings="$settings"
    :nav-links="$navLinks"
    :page-title="$item->title.' — '.$settings->company_name"
    :page-description="$item->excerpt">

    <article style="max-width:880px;margin:0 auto;padding:56px 32px 32px;">
        <nav style="font-size:13px;color:var(--muted);margin-bottom:24px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            <a href="{{ route('home') }}" style="color:var(--muted);">Главная</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" style="color:var(--muted);">Новости</a>
            <span>/</span>
            <span style="color:#aab4c2;">{{ \Illuminate\Support\Str::limit($item->title, 60) }}</span>
        </nav>

        <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">
            {{ $dateStr }}
        </div>
        <h1 style="font-size:42px;font-weight:700;letter-spacing:-0.025em;line-height:1.15;margin:0 0 22px;color:var(--navy);">{{ $item->title }}</h1>
        @if($item->excerpt)
            <p style="font-size:19px;line-height:1.6;color:var(--muted);margin:0 0 36px;">{{ $item->excerpt }}</p>
        @endif
    </article>

    @if($item->image_path)
        <div style="max-width:880px;margin:0 auto 48px;padding:0 32px;">
            <div style="width:100%;aspect-ratio:16/9;border-radius:14px;overflow:hidden;background:var(--tint);border:1px solid var(--line);">
                <img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
            </div>
        </div>
    @endif

    <article style="max-width:760px;margin:0 auto;padding:0 32px 80px;">
        @if($item->body)
            <div style="font-size:17px;line-height:1.78;color:var(--ink);">
                @foreach(preg_split('/\R\s*\R/', trim($item->body)) as $para)
                    @if(trim($para) !== '')
                        <p style="margin:0 0 22px;">{!! nl2br(e($para)) !!}</p>
                    @endif
                @endforeach
            </div>
        @endif

        <div style="margin-top:48px;padding-top:32px;border-top:1px solid var(--line);display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap;">
            <a href="{{ route('news.index') }}" style="display:inline-flex;align-items:center;gap:8px;font-size:14.5px;font-weight:600;color:var(--accent);">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Все новости
            </a>
            @if($ctaEnabled && $ctaLabel && $ctaHref)
                <a href="{{ $ctaHref }}"
                   @if($ctaNewTab) target="_blank" rel="noopener" @endif
                   style="background:var(--accent);color:#fff;font-weight:600;font-size:14px;padding:11px 22px;border-radius:9px;">{{ $ctaLabel }}</a>
            @endif
        </div>
    </article>

    @if($related->isNotEmpty())
        <section style="background:var(--tint);border-top:1px solid var(--line);">
            <div style="max-width:1200px;margin:0 auto;padding:64px 32px 80px;">
                <h2 style="font-size:28px;font-weight:700;letter-spacing:-0.02em;margin:0 0 28px;color:var(--navy);">Похожие материалы</h2>
                <div class="grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px;">
                    @foreach($related as $rel)
                        @include('site.partials.news-card', ['item' => $rel])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-site-layout>
