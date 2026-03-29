@extends('layouts.app')

@section('title', 'Teta Zahwe Catering — Homemade Lebanese Food')
@section('description', 'Fresh homemade Lebanese catering for weddings, corporate events and daily meals. Updated weekly
menu with QR access.')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
HERO
════════════════════════════════════════════════════════════ --}}
<section class="hero" id="home">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-bg-word">طبخات</div>

    <div class="hero-images">
        <div class="hero-img-tall">
            <img src="{{ asset('images/hero-1.jpg') }}" alt="Homemade Lebanese food" />
        </div>
        <div class="hero-img-stack">
            <div class="hero-img-sq">
                <img src="{{ asset('images/hero-2.jpg') }}" alt="Fresh dishes" />
            </div>
            <div class="hero-img-sq">
                <img src="{{ asset('images/hero-3.jpg') }}" alt="Lebanese cuisine" />
            </div>
        </div>
    </div>

    <div class="hero-content">
        <div class="hero-eyebrow" data-reveal>Lebanese Home Cooking</div>
        <div class="hero-logo-wrap" data-reveal data-delay="100">
            <img src="{{ asset('images/teta-zahwe-logo.svg') }}" alt="Teta Zahwe Catering" class="hero-logo-img" />
        </div>
        <p class="hero-desc" data-reveal data-delay="200">
            Homemade Lebanese meals for weddings, corporate events,
            and daily catering — crafted fresh every single day
            with love and tradition.
        </p>
        <div class="hero-btns" data-reveal data-delay="300">
            <a href="{{ route('menu.index') }}" class="btn-primary">This Week's Menu</a>
            <a href="https://wa.me/9613486616" target="_blank" class="btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                    <path
                        d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                Order via WhatsApp
            </a>
        </div>
    </div>

    <div class="hero-scroll">
        <div class="hero-scroll-line"></div>
        <div class="hero-scroll-text">Scroll</div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
TICKER
════════════════════════════════════════════════════════════ --}}
<div class="ticker">
    <div class="ticker-track">
        <span class="ticker-item">Weddings</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Daily Meals</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Corporate Events</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Private Gatherings</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Lebanese Cuisine</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Fresh Ingredients</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">Homemade Recipes</span><span class="ticker-sep">✦</span>
        <span class="ticker-item">+961 3 48 66 16</span><span class="ticker-sep">✦</span>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
ABOUT
════════════════════════════════════════════════════════════ --}}
<section class="about" id="about">
    <div class="about-left">
        <div class="eyebrow" data-reveal>Our Story</div>
        <h2 class="display" data-reveal data-delay="100">
            Cooked with love,<br>
            served with <em>pride.</em>
        </h2>
        <p class="body-text" data-reveal data-delay="200">
            Teta Zahwe started as a family kitchen and grew into one of the most
            trusted names in Lebanese catering. Every dish is prepared fresh each
            morning using traditional recipes passed down through generations.
        </p>
        <div class="value-list" data-reveal data-delay="300">
            <div class="value-row">Fresh ingredients sourced every morning</div>
            <div class="value-row">Traditional Lebanese family recipes</div>
            <div class="value-row">Weekly rotating menu — never repetitive</div>
            <div class="value-row">Salad, dessert & full service with every meal</div>
            <div class="value-row">On-time delivery, every time</div>
        </div>
        <a href="{{ route('reservation') }}" class="btn-primary" data-reveal data-delay="400">Get in Touch</a>
    </div>

    <div class="about-right">
        <div class="about-right-glow"></div>
        <div class="about-big-bg">15</div>
        <div class="about-stats" data-reveal="scale">
            <div class="stat-main" data-counter="15" data-suffix="+">15+</div>
            <div class="stat-main-label">Years of Experience</div>
            <div class="about-divider"></div>
            <div class="stats-row">
                <div>
                    <div class="stat-item-num" data-counter="500" data-suffix="+">500+</div>
                    <div class="stat-item-label">Events Catered</div>
                </div>
                <div>
                    <div class="stat-item-num" data-counter="100" data-suffix="%">100%</div>
                    <div class="stat-item-label">Fresh Daily</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
GALLERY
════════════════════════════════════════════════════════════ --}}
<section class="gallery-section" id="gallery">
    <div class="gallery-header">
        <div class="eyebrow centered" data-reveal>Our Work</div>
        <h2 class="display" style="text-align:center;" data-reveal data-delay="100">
            A taste of what<br>we <em>create.</em>
        </h2>
        <p class="body-text" style="text-align:center; max-width:480px; margin:0 auto;" data-reveal data-delay="200">
            From intimate family gatherings to grand wedding celebrations —
            every event crafted with the same love and care.
        </p>
    </div>

    <div class="gallery-grid" data-stagger>

        {{-- Large left item --}}
        <div class="gallery-item gallery-item-lg" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Catering event" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Wedding</div>
                </div>
            </div>
        </div>

        {{-- Right column: two stacked --}}
        <div class="gallery-item" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Homemade dishes" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Daily Meals</div>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt="Lebanese cuisine" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Lebanese Cuisine</div>
                </div>
            </div>
        </div>

        {{-- Bottom row: three equal --}}
        <div class="gallery-item" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Corporate catering" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Corporate Event</div>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-5.jpg') }}" alt="Private gathering" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Private Event</div>
                </div>
            </div>
        </div>

        <div class="gallery-item" data-stagger-item>
            <div class="gallery-img">
                <img src="{{ asset('images/gallery/gallery-6.jpg') }}" alt="Fresh food" loading="lazy"
                    onerror="this.parentElement.classList.add('gallery-img-placeholder')" />
                <div class="gallery-overlay">
                    <div class="gallery-overlay-tag">Fresh & Homemade</div>
                </div>
            </div>
        </div>

    </div>

    <div style="text-align:center; margin-top:48px;" data-reveal>
        <a href="{{ route('reservation') }}" class="btn-primary">Book Your Event</a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
SERVICES
════════════════════════════════════════════════════════════ --}}
<section class="services-section" id="services">
    <div class="services-header">
        <div class="eyebrow centered" data-reveal>What We Offer</div>
        <h2 class="display" style="text-align:center;" data-reveal data-delay="100">
            Every occasion,<br><em>covered.</em>
        </h2>
    </div>

    <div class="services-grid" data-stagger>
        <div class="service-card" data-stagger-item>
            <div class="service-icon">💍</div>
            <div class="service-num">01</div>
            <div class="service-title">Weddings &<br>Celebrations</div>
            <p class="service-desc">Full catering for weddings, engagements, and milestone celebrations. We handle
                everything from setup to full table service.</p>
            <a href="{{ route('reservation') }}" class="service-link">Enquire Now →</a>
        </div>
        <div class="service-card" data-stagger-item>
            <div class="service-icon">🏢</div>
            <div class="service-num">02</div>
            <div class="service-title">Corporate<br>Daily Meals</div>
            <p class="service-desc">Weekly subscriptions for offices and companies. Fresh, rotating Lebanese lunch
                delivered daily — on time, every time.</p>
            <a href="{{ route('reservation') }}" class="service-link">Get a Quote →</a>
        </div>
        <div class="service-card" data-stagger-item>
            <div class="service-icon">🏠</div>
            <div class="service-num">03</div>
            <div class="service-title">Private &<br>Family Events</div>
            <p class="service-desc">From intimate family gatherings to large private parties — homemade food served with
                full Lebanese hospitality.</p>
            <a href="{{ route('reservation') }}" class="service-link">Book Now →</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
TESTIMONIALS
════════════════════════════════════════════════════════════ --}}
<section class="testimonials-section">
    <div class="testimonials-bg-quote">"</div>
    <div class="eyebrow" data-reveal>Client Reviews</div>
    <h2 class="display" data-reveal data-delay="100" style="color:#fff;">
        Loved by every<br>table we <em>serve.</em>
    </h2>

    <div class="test-grid" data-stagger>
        <div class="test-card" data-stagger-item>
            <div class="test-quote-mark">"</div>
            <p class="test-text">Teta Zahwe catered our entire wedding and every single guest was asking who made the
                food. Warm, fresh, and cooked with so much love.</p>
            <div class="test-author">
                <div class="test-avatar">👰</div>
                <div>
                    <div class="test-name">Lara & Karim H.</div>
                    <div class="test-role">Wedding · Beirut</div>
                </div>
                <div class="test-stars">★★★★★</div>
            </div>
        </div>
        <div class="test-card" data-stagger-item>
            <div class="test-quote-mark">"</div>
            <p class="test-text">We've been ordering daily lunches for our office for over a year. The quality never
                drops and the weekly menu always keeps the team excited.</p>
            <div class="test-author">
                <div class="test-avatar">💼</div>
                <div>
                    <div class="test-name">Ahmad M.</div>
                    <div class="test-role">Corporate Client · Hamra</div>
                </div>
                <div class="test-stars">★★★★★</div>
            </div>
        </div>
        <div class="test-card" data-stagger-item>
            <div class="test-quote-mark">"</div>
            <p class="test-text">The QR menu is genius — I just scan and I know exactly what's cooking this week. The
                kibbeh is like my own teta used to make. Unbelievable.</p>
            <div class="test-author">
                <div class="test-avatar">🏠</div>
                <div>
                    <div class="test-name">Nadia F.</div>
                    <div class="test-role">Regular Customer · Jounieh</div>
                </div>
                <div class="test-stars">★★★★★</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
CONTACT CTA
════════════════════════════════════════════════════════════ --}}
<section style="background: var(--pink-pale); padding: 100px 80px; text-align: center;">
    <div class="eyebrow centered" data-reveal>Ready to Order?</div>
    <h2 class="display" style="text-align:center;" data-reveal data-delay="100">
        Let's cook something<br><em>together.</em>
    </h2>
    <p class="body-text" style="text-align:center; max-width:480px; margin: 0 auto 36px;" data-reveal data-delay="200">
        Whether it's a wedding, daily meals, or a private event —
        reach out and we'll take care of everything.
    </p>
    <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;" data-reveal data-delay="300">
        <a href="{{ route('contact') }}" class="btn-primary">Send a Message</a>
        <a href="https://wa.me/9613486616" target="_blank" class="btn-primary" style=" border-color:var(--pink);">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                <path
                    d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
            </svg>
            WhatsApp Us
        </a>
    </div>
</section>

@endsection