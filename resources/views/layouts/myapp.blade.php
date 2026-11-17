<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @include('partials.seo')
    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="/images/logos/LOGOtext.png">
    <link rel="apple-touch-icon" href="/images/logos/LOGOtext.png">
    @vite('resources/js/flowbite.min.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.default.min.css">
    <style>
        html { scroll-behavior: smooth; }
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1 0 auto; }
        .ts-wrapper {
            width: 100%;
            border: 0 !important;
            box-shadow: none !important;
            background: transparent !important;
            padding: 0 !important;
        }
        .ts-control {
            border-radius: 0.5rem !important;
            border: 1px solid #d1d5db !important;
            min-height: 40px;
            padding: 0.35rem 0.65rem !important;
            box-shadow: none !important;
            background: #fff !important;
            outline: none !important;
        }
        .ts-wrapper.focus .ts-control {
            border-color: #ff9b00 !important;
            box-shadow: 0 0 0 2px rgba(255, 155, 0, 0.15) !important;
        }
        .ts-dropdown {
            border-radius: 0.5rem !important;
            border-color: #e5e7eb !important;
            overflow: hidden;
        }
        .ts-dropdown .active { background-color: #fff5e6 !important; color: #111827 !important; }
    </style>
</head>

@php
    $isAdminUser = Auth::check() && Auth::user()->role === 'admin';
    $isAdminArea = request()->is('buta_manager/*');
@endphp

<body class="bg-sec-400">

    {{-- -------------------------------------------------------------- Header -------------------------------------------------------------- --}}
    @if ($isAdminUser && $isAdminArea)
        <header>
            <nav class="sticky top-0 z-40 border-b border-gray-200/80 bg-white/95 px-4 py-2 backdrop-blur lg:px-6">
                <div class="flex flex-wrap items-center justify-between gap-2 mx-auto max-w-screen-xl">
                    <a href="{{ route('home') }}" class="flex items-center" title="{{ __('View site') }}">
                        <img loading="lazy" src="/images/logos/LOGOtext.png" class="mr-2 h-8 w-auto" alt="{{ config('app.name') }}" />
                    </a>

                    <div class="hidden justify-between items-center w-full lg:flex lg:w-auto" id="mobile-menu-2">
                        <ul class="flex flex-col font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="{{ route('adminDashboard') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Dashboard') }}</div>
                                        <div class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cars.index') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Cars') }}</div>
                                        <div class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('insurances.index') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Insurances') }}</div>
                                        <div class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Users') }}</div>
                                        <div class="block invisible bg-pr-400 w-10 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('siteContent.edit') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Site content') }}</div>
                                        <div class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pages.index') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Pages') }}</div>
                                        <div class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    @include('partials.lang-switcher')
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center"
                        type="button">
                        <img loading="lazy" src="/images/user.png" width="24" alt="user icon" class="mr-3">
                        <p>Admin ( {{ Auth::user()->name }} )</p>
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-pr-200">{{ __('View site') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('adminDashboard') }}" class="block px-4 py-2 hover:bg-pr-200">{{ __('Dashboard') }}</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 hover:bg-pr-200" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                            </li>
                        </ul>
                    </div>

                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </nav>
        </header>
    @else
        <header>
            <nav class="sticky top-0 z-40 border-b border-gray-200/80 bg-white/95 px-4 py-2 backdrop-blur lg:px-6">
                <div class="flex flex-wrap items-center justify-between gap-2 mx-auto max-w-screen-xl">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img loading="lazy" src="/images/logos/LOGOtext.png" class="mr-2 h-8 w-auto" alt="{{ config('app.name') }}" />
                    </a>

                    <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="{{ route('home') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Home') }}</div>
                                        <div class="block invisible bg-pr-400 w-12 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cars') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Cars') }}</div>
                                        <div class="block invisible bg-pr-400 w-8 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('location') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Location') }}</div>
                                        <div class="block invisible bg-pr-400 w-16 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact_us') }}">
                                    <div class="group text-center">
                                        <div class="group-hover:cursor-pointer">{{ __('Contact Us') }}</div>
                                        <div class="block invisible bg-pr-400 w-20 h-1 rounded-md text-center -bottom-1 mx-auto relative group-hover:visible"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="flex items-center gap-2 lg:order-2">
                        @include('partials.lang-switcher')

                        @auth
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="text-black bg-pr-400 hover:bg-pr-600 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center"
                                type="button">
                                <img loading="lazy" src="/images/user.png" width="24" alt="user icon" class="mr-3">
                                @if ($isAdminUser)
                                    Admin ( {{ Auth::user()->name }} )
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                    @if ($isAdminUser)
                                        <li>
                                            <a href="{{ route('adminDashboard') }}" class="block px-4 py-2 hover:bg-pr-200">{{ __('admin panel') }}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('clientReservation') }}" class="block px-4 py-2 hover:bg-pr-200">{{ __('Reservations') }}</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="block px-4 py-2 hover:bg-pr-200" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                                    </li>
                                </ul>
                            </div>
                        @endauth

                        <button data-collapse-toggle="mobile-menu-2" type="button"
                            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            aria-controls="mobile-menu-2" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>
        </header>
    @endif

    {{-- --------------------------------------------------------------- Main  --------------------------------------------------------------- --}}
    <main>
        @include('partials.alerts')
        @yield('content')
    </main>
    {{-- --------------------------------------------------------------- Footer  --------------------------------------------------------------- --}}
    @if ($isAdminUser && $isAdminArea)
        <footer class="px-4 h-[100px] sm:p-6 bg-gray-800 flex justify-center items-center">
            <p class="text-gray-100 font-car font-medium text-5xl">{{ __('admin panel') }}</p>
        </footer>
    @else
        @php
            $footerBrand = setting('contact.company_name') ?: 'RealRentCar';
            $footerBrand = preg_replace('/\s+LLC$/i', '', $footerBrand) ?: 'RealRentCar';
            $socialLinks = collect([
                'facebook' => setting('social.facebook'),
                'instagram' => setting('social.instagram'),
                'whatsapp' => setting('social.whatsapp'),
                'telegram' => setting('social.telegram'),
                'youtube' => setting('social.youtube'),
                'tiktok' => setting('social.tiktok'),
                'linkedin' => setting('social.linkedin'),
                'x' => setting('social.x'),
            ])->filter(fn ($url) => filled($url));
        @endphp

        <footer class="site-footer">
            <div class="site-footer-inner">
                <div class="site-footer-grid">
                    <div class="site-footer-brand">
                        <a href="{{ route('home') }}">
                            <img loading="lazy" src="/images/logos/LogoTextDark.png" alt="{{ $footerBrand }}">
                        </a>
                        <p>{{ setting('contact.company_name', $footerBrand) }}</p>
                        @if (setting('contact.phone'))
                            <a class="site-footer-phone" href="tel:{{ preg_replace('/\s+/', '', setting('contact.phone')) }}">{{ setting('contact.phone') }}</a>
                        @endif
                    </div>

                    <div>
                        <h2>{{ __('Menu') }}</h2>
                        <ul>
                            <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('cars') }}">{{ __('Cars') }}</a></li>
                            <li><a href="{{ route('location') }}">{{ __('Location') }}</a></li>
                            <li><a href="{{ route('contact_us') }}">{{ __('Contact Us') }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h2>{{ __('Cars') }}</h2>
                        <ul>
                            <li><a href="{{ route('cars') }}">{{ __('All rental cars') }}</a></li>
                            <li><a href="{{ route('carSearch') }}">{{ __('Search') }}</a></li>
                            @auth
                                @if (! $isAdminUser)
                                    <li><a href="{{ route('clientReservation') }}">{{ __('Reservations') }}</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>

                    <div>
                        <h2>{{ __('Legal') }}</h2>
                        <ul>
                            <li><a href="{{ route('privacy_policy') }}">{{ __('Privacy Policy') }}</a></li>
                            <li><a href="{{ route('terms_conditions') }}">{{ __('Terms & Conditions') }}</a></li>
                            <li><a href="{{ route('contact_us') }}">{{ __('Contact Us') }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="site-footer-bottom">
                    <span>© {{ date('Y') }} <a href="{{ route('home') }}">{{ $footerBrand }}</a>. {{ __('All Rights Reserved.') }}</span>

                    @if ($socialLinks->isNotEmpty())
                        <div class="site-footer-social">
                            @foreach ($socialLinks as $network => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($network) }}">
                                    @include('partials.social-icon', ['network' => $network])
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <button type="button" class="site-footer-top" onclick="scrollToTop();" aria-label="{{ __('Back to top') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 4l-7 7h4v9h6v-9h4l-7-7z"/>
                    </svg>
                </button>
            </div>
        </footer>

        <style>
            .site-footer { background: #1f2937; color: #9ca3af; padding: 2.5rem 1rem 1.5rem; }
            .site-footer-inner { position: relative; max-width: 1280px; margin: 0 auto; }
            .site-footer-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            @media (min-width: 768px) {
                .site-footer-grid { grid-template-columns: 1.4fr 1fr 1fr 1fr; gap: 1.5rem 2rem; align-items: start; }
            }
            .site-footer-brand img { height: 56px; width: auto; display: block; margin-bottom: 0.75rem; }
            .site-footer-brand p { margin: 0 0 0.35rem; color: #d1d5db; font-size: 0.9rem; }
            .site-footer-phone { color: #ff9b00; font-weight: 600; text-decoration: none; font-size: 0.95rem; }
            .site-footer-phone:hover { text-decoration: underline; }
            .site-footer h2 {
                margin: 0 0 0.85rem;
                color: #fff;
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }
            .site-footer ul { list-style: none; margin: 0; padding: 0; }
            .site-footer li + li { margin-top: 0.55rem; }
            .site-footer a { color: #9ca3af; text-decoration: none; font-size: 0.9rem; }
            .site-footer a:hover { color: #fff; text-decoration: underline; }
            .site-footer-bottom {
                margin-top: 2rem;
                padding-top: 1.25rem;
                border-top: 1px solid #374151;
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                align-items: center;
                justify-content: space-between;
            }
            .site-footer-bottom span { font-size: 0.85rem; color: #9ca3af; }
            .site-footer-bottom span a { color: #d1d5db; }
            .site-footer-social { display: flex; flex-wrap: wrap; gap: 0.5rem; }
            .site-footer-social a {
                width: 36px; height: 36px; border-radius: 9999px;
                display: inline-flex; align-items: center; justify-content: center;
                background: #374151; color: #fff; text-decoration: none;
            }
            .site-footer-social a svg { fill: currentColor; color: inherit; }
            .site-footer-social a:hover,
            .site-footer-social a:focus-visible {
                background: #ff9b00;
                color: #111827;
                text-decoration: none;
            }
            .site-footer-social a:hover svg,
            .site-footer-social a:focus-visible svg {
                fill: #111827;
                color: #111827;
            }
            .site-footer-top {
                position: absolute;
                top: 0;
                right: 0;
                width: 42px;
                height: 42px;
                border: 0;
                border-radius: 9999px;
                background: #ff9b00;
                color: #111827;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            }
            .site-footer-top svg {
                width: 18px;
                height: 18px;
                fill: #111827;
                display: block;
            }
            .site-footer-top:hover,
            .site-footer-top:focus-visible {
                background: #e68c00;
                color: #ffffff;
                outline: none;
            }
            .site-footer-top:hover svg,
            .site-footer-top:focus-visible svg {
                fill: #ffffff;
            }
        </style>
    @endif


</body>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    window.createSearchableSelect = function (el, options) {
        if (!el || typeof TomSelect === 'undefined') {
            return null;
        }
        if (el.tomselect) {
            el.tomselect.destroy();
        }
        return new TomSelect(el, Object.assign({
            allowEmptyOption: true,
            create: false,
            maxOptions: null,
            sortField: { field: 'text', direction: 'asc' },
            placeholder: el.getAttribute('data-placeholder') || @json(__('Type to search...')),
            plugins: ['dropdown_input'],
            render: {
                no_results: function () {
                    return '<div class="no-results">' + @json(__('No results found')) + '</div>';
                }
            }
        }, options || {}));
    };

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('select.js-searchable').forEach(function (el) {
            window.createSearchableSelect(el);
        });
    });
</script>

</html>
