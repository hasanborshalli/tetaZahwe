<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Teta Zahwe Catering')</title>
    <meta name="description"
        content="@yield('description', 'Homemade Lebanese catering for weddings, events and daily meals. Fresh every day.')" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @stack('styles')
</head>

<body>

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">

            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/teta-zahwe-logo.svg') }}" alt="Teta Zahwe" class="nav-logo-img" />
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home')        ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('menu.index') }}"
                        class="{{ request()->routeIs('menu.*')       ? 'active' : '' }}">Weekly Menu</a></li>
                <li><a href="{{ route('home') }}#about" class="">About</a></li>
                <li><a href="{{ route('home') }}#services" class="">Services</a></li>
                <li><a href="{{ route('reservation') }}"
                        class="{{ request()->routeIs('reservation') ? 'active' : '' }}">Reserve</a></li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact')     ? 'active' : '' }}">Contact</a></li>
            </ul>

            <div class="nav-right">
                <span class="nav-phone">+961 3 48 66 16</span>
                <a href="https://wa.me/9613486616" target="_blank" class="btn-wa-nav">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                    </svg>
                    WhatsApp
                </a>
                <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <div class="nav-mobile" id="navMobile">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('menu.index') }}">Weekly Menu</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#services">Services</a>
            <a href="{{ route('reservation') }}">Reserve an Event</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="https://wa.me/9613486616" target="_blank" class="mobile-wa">📱 Order via WhatsApp</a>
        </div>
    </nav>

    {{-- ── FLASH MESSAGE ───────────────────────────────────────────── --}}
    @if(session('success'))
    <div class="flash flash-success" id="flashMsg">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="flash flash-error" id="flashMsg">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- ── PAGE CONTENT ────────────────────────────────────────────── --}}
    @yield('content')

    {{-- ── FOOTER ─────────────────────────────────────────────────── --}}
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-brand">
                <div class="footer-logo-en">Teta Zahwe</div>
                <div class="footer-logo-ar">تيتا زهوة · Catering</div>
                <p class="footer-tagline">Homemade Lebanese food for every occasion — made fresh, served with love every
                    single day.</p>
                <div class="footer-socials">
                    <a href="#" class="social-circle" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                        </svg>
                    </a>
                    <a href="#" class="social-circle" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="https://wa.me/9613486616" target="_blank" class="social-circle" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <div class="footer-col-head">Navigation</div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('menu.index') }}">Weekly Menu</a></li>
                    <li><a href="{{ route('home') }}#about">About Us</a></li>
                    <li><a href="{{ route('home') }}#services">Services</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col-head">Services</div>
                <ul>
                    <li><a href="{{ route('home') }}#services">Wedding Catering</a></li>
                    <li><a href="{{ route('home') }}#services">Corporate Meals</a></li>
                    <li><a href="{{ route('home') }}#services">Daily Subscriptions</a></li>
                    <li><a href="{{ route('home') }}#services">Private Events</a></li>
                    <li><a href="{{ route('qr') }}">QR Menu</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <div class="footer-col-head">Contact</div>
                <ul>
                    <li><a href="tel:+9613486616">+961 3 48 66 16</a></li>
                    <li><a href="https://wa.me/9613486616" target="_blank">WhatsApp Us</a></li>
                    <li><span>Beirut, Lebanon</span></li>
                    <li><span>Daily 8:00 AM – 8:00 PM</span></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">© {{ date('Y') }} Teta Zahwe Catering · All Rights Reserved</span>
            <span class="footer-copy">Made with ❤️ in Lebanon</span>
        </div>
    </footer>

    {{-- ── FLOATING WHATSAPP ───────────────────────────────────────── --}}
    <a href="https://wa.me/9613486616" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
            <path
                d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
        </svg>
    </a>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>