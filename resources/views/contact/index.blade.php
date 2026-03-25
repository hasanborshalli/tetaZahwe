@extends('layouts.app')

@section('title', 'Contact — Teta Zahwe Catering')
@section('description', 'Get in touch with Teta Zahwe Catering for weddings, events, daily meals, or any enquiry.')

@section('content')

{{-- Page header --}}
<div class="contact-hero-wrap">
    <div class="contact-hero-bg-word">Hello</div>
    <div style="position:relative; z-index:2;">
        <div class="eyebrow" style="color:var(--pink);" data-reveal>Let's Talk</div>
        <h1 style="font-family:var(--font-serif); font-size:60px; font-weight:900; color:#fff; line-height:1; letter-spacing:-1px;"
            data-reveal data-delay="100">
            Get in <em style="font-style:italic; color:var(--pink);">Touch.</em>
        </h1>
    </div>
</div>

{{-- Contact section --}}
<section class="contact-section">

    {{-- Left: info --}}
    <div data-reveal>
        <div class="eyebrow">Reach Us</div>
        <h2 class="display" style="font-size:40px;">
            We're always<br>happy to <em>help.</em>
        </h2>
        <p class="body-text">
            Whether you're planning a wedding, need daily meals for
            your office, or just want to ask about today's menu — we're
            here. Reach out and we'll get back to you quickly.
        </p>

        <div class="contact-items">
            <div class="contact-item">
                <div class="contact-icon">📞</div>
                <div>
                    <div class="contact-label">Phone & WhatsApp</div>
                    <div class="contact-value">
                        <a href="tel:+9613486616" style="color:var(--dark); text-decoration:none;">+961 3 48 66 16</a>
                    </div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">📍</div>
                <div>
                    <div class="contact-label">Location</div>
                    <div class="contact-value">Beirut, Lebanon</div>
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon">🕐</div>
                <div>
                    <div class="contact-label">Working Hours</div>
                    <div class="contact-value">Daily · 8:00 AM – 8:00 PM</div>
                </div>
            </div>
        </div>

        <a href="https://wa.me/9613486616" target="_blank" class="btn-whatsapp" style="margin-top:8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                <path
                    d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
            </svg>
            Chat on WhatsApp
        </a>
    </div>

    {{-- Right: form --}}
    <div data-reveal="right">
        <div class="contact-form-wrap">
            <div class="form-title">Send a Message</div>
            <div class="form-subtitle">We'll reply within a few hours</div>

            <form action="{{ route('contact.send') }}" method="POST" id="contactForm" novalidate>
                @csrf

                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label" for="name">Full Name *</label>
                        <input type="text" id="name" name="name"
                            class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Your name"
                            value="{{ old('name') }}" required />
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone"
                            class="form-input {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="+961 ..."
                            value="{{ old('phone') }}" required />
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label" for="email">Email (optional)</label>
                        <input type="email" id="email" name="email"
                            class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            placeholder="your@email.com" value="{{ old('email') }}" />
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="event_type">Event Type</label>
                        <select id="event_type" name="event_type" class="form-select">
                            <option value="">Select type...</option>
                            <option value="Wedding" {{ old('event_type')==='Wedding' ? 'selected' : '' }}>Wedding
                            </option>
                            <option value="Corporate Meals" {{ old('event_type')==='Corporate Meals' ? 'selected' : ''
                                }}>Corporate Meals</option>
                            <option value="Daily Subscription" {{ old('event_type')==='Daily Subscription' ? 'selected'
                                : '' }}>Daily Subscription</option>
                            <option value="Private Event" {{ old('event_type')==='Private Event' ? 'selected' : '' }}>
                                Private Event</option>
                            <option value="Other" {{ old('event_type')==='Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-row" style="margin-bottom:14px;">
                    <div class="form-field">
                        <label class="form-label" for="event_date">Preferred Date</label>
                        <input type="date" id="event_date" name="event_date" class="form-input"
                            value="{{ old('event_date') }}" />
                    </div>
                </div>

                <div style="margin-bottom:14px;">
                    <label class="form-label" for="message">Message *</label>
                    <textarea id="message" name="message"
                        class="form-textarea {{ $errors->has('message') ? 'is-invalid' : '' }}"
                        placeholder="Tell us about your order or event..." required>{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="form-submit">Send Message →</button>
            </form>
        </div>
    </div>

</section>

@endsection