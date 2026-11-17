@php
    $seoTitle = trim($__env->yieldContent('title', config('seo.default_title')));
    $seoDescription = trim($__env->yieldContent('meta_description', config('seo.default_description')));
    $seoKeywords = trim($__env->yieldContent('meta_keywords', config('seo.default_keywords')));
    $seoImage = trim($__env->yieldContent('og_image', config('seo.og_image')));
    $defaultRobots = request()->is('buta_manager') || request()->is('buta_manager/*') || request()->is('reservations*') || request()->is('invoice*')
        ? 'noindex,nofollow'
        : 'index,follow,max-image-preview:large';
    $seoRobots = trim($__env->yieldContent('robots', $defaultRobots));
    $canonical = trim($__env->yieldContent('canonical', url()->current()));
    $ogType = trim($__env->yieldContent('og_type', 'website'));
    $locale = app()->getLocale();
    $ogLocale = config('seo.locale_map.'.$locale, 'az_AZ');
    $absoluteImage = str_starts_with($seoImage, 'http') ? $seoImage : url($seoImage);
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="author" content="{{ config('seo.site_name') }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:site_name" content="{{ config('seo.site_name') }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $absoluteImage }}">
<meta property="og:locale" content="{{ $ogLocale }}">
@foreach (['az', 'en', 'ru'] as $altLocale)
    @if ($altLocale !== $locale)
        <meta property="og:locale:alternate" content="{{ config('seo.locale_map.'.$altLocale) }}">
    @endif
@endforeach

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $absoluteImage }}">
@if (config('seo.twitter_handle'))
    <meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
@endif

@foreach (['az', 'en', 'ru'] as $hreflang)
    <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ url()->current() }}?lang={{ $hreflang }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

@stack('jsonld')
