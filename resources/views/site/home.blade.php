@php
    $phoneDigits = preg_replace('/\D+/', '', $settings->phone ?? '');
    $phoneHref = 'tel:+' . $phoneDigits;
    $mailHref = 'mailto:' . $settings->email;
@endphp
<x-site-layout :settings="$settings" :nav-links="$navLinks">
    @if($settings->hero_variant === 'b')
        @include('site.partials.hero-b')
    @else
        @include('site.partials.hero-a')
    @endif

    @include('site.partials.trust')
    @include('site.partials.services')
    @include('site.partials.advantages')
    @include('site.partials.about')
    @include('site.partials.licenses')

    @if($settings->show_news && $news->isNotEmpty())
        @include('site.partials.news')
    @endif

    @include('site.partials.zayavka')
    @include('site.partials.contacts')
</x-site-layout>
