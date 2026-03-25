@extends('layouts.app')

@section('title', 'Book an Event — Teta Zahwe Catering')
@section('description', 'Reserve your catering event with Teta Zahwe. Weddings, corporate, private events.')

@section('content')

{{-- Page header --}}
<div class="contact-hero-wrap">
    <div class="contact-hero-bg-word">Reserve</div>
    <div style="position:relative; z-index:2;">
        <div class="eyebrow" style="color:var(--pink);" data-reveal>Event Booking</div>
        <h1 style="font-family:var(--font-display); font-size:60px; font-weight:900; color:#fff; line-height:1; letter-spacing:-1px;"
            data-reveal data-delay="100">
            Book Your <em style="font-style:italic; color:var(--pink);">Event.</em>
        </h1>
    </div>
</div>

<section class="reservation-section">

    {{-- Left: info --}}
    <div data-reveal>
        <div class="eyebrow">How it works</div>
        <h2 class="display" style="font-size:40px;">
            Tell us about<br>your <em>event.</em>
        </h2>
        <p class="body-text">
            Fill in the form with your event details and we'll reach out
            on WhatsApp to discuss the menu, confirm availability, and
            finalize everything for you.
        </p>

        <div class="reservation-steps">
            <div class="reservation-step">
                <div class="reservation-step-num">1</div>
                <div>
                    <div class="reservation-step-title">Fill the form</div>
                    <div class="reservation-step-desc">Event type, date, budget and your contact</div>
                </div>
            </div>
            <div class="reservation-step">
                <div class="reservation-step-num">2</div>
                <div>
                    <div class="reservation-step-title">We receive it on WhatsApp</div>
                    <div class="reservation-step-desc">Your request lands directly in our WhatsApp</div>
                </div>
            </div>
            <div class="reservation-step">
                <div class="reservation-step-num">3</div>
                <div>
                    <div class="reservation-step-title">We confirm & plan</div>
                    <div class="reservation-step-desc">We'll discuss the menu and every detail with you</div>
                </div>
            </div>
        </div>

        <div style="margin-top:32px;">
            <a href="{{ route('contact') }}" style="font-size:12px; color:var(--mid);">
                Just want to send a message? →
            </a>
        </div>
    </div>

    {{-- Right: form --}}
    <div data-reveal="right">
        <div class="contact-form-wrap">
            <div class="form-title">Reservation Request</div>
            <div class="form-subtitle">Submitting opens WhatsApp with your details</div>

            <form action="{{ route('reservation.send') }}" method="POST" id="reservationForm" novalidate>
                @csrf

                {{-- Event Type --}}
                <div style="margin-bottom:14px;">
                    <label class="form-label" for="event_type">Event Type *</label>
                    <select id="event_type" name="event_type"
                        class="form-select {{ $errors->has('event_type') ? 'is-invalid' : '' }}" required>
                        <option value="">Select event type...</option>
                        <option value="Wedding" {{ old('event_type')==='Wedding' ? 'selected' : '' }}>💍 Wedding
                        </option>
                        <option value="Engagement" {{ old('event_type')==='Engagement' ? 'selected' : '' }}>💐
                            Engagement</option>
                        <option value="Corporate Event" {{ old('event_type')==='Corporate Event' ? 'selected' : '' }}>🏢
                            Corporate Event</option>
                        <option value="Daily Meals" {{ old('event_type')==='Daily Meals' ? 'selected' : '' }}>🍽 Daily
                            Meals Subscription</option>
                        <option value="Private Gathering" {{ old('event_type')==='Private Gathering' ? 'selected' : ''
                            }}>🏠 Private Gathering</option>
                        <option value="Birthday" {{ old('event_type')==='Birthday' ? 'selected' : '' }}>🎂 Birthday
                            Party</option>
                        <option value="Other" {{ old('event_type')==='Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('event_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Name & Phone --}}
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

                {{-- Date & Budget --}}
                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label" for="event_date">Event Date *</label>
                        <input type="date" id="event_date" name="event_date"
                            class="form-input {{ $errors->has('event_date') ? 'is-invalid' : '' }}"
                            value="{{ old('event_date') }}" required min="{{ now()->addDay()->format('Y-m-d') }}" />
                        @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="price_range">Budget Range *</label>
                        <select id="price_range" name="price_range"
                            class="form-select {{ $errors->has('price_range') ? 'is-invalid' : '' }}" required>
                            <option value="">Select budget...</option>
                            <option value="Under $500" {{ old('price_range')==='Under $500' ? 'selected' : '' }}>Under
                                $500</option>
                            <option value="$500 – $1,000" {{ old('price_range')==='$500 – $1,000' ? 'selected' : '' }}>
                                $500 – $1,000</option>
                            <option value="$1,000 – $2,500" {{ old('price_range')==='$1,000 – $2,500' ? 'selected' : ''
                                }}>$1,000 – $2,500</option>
                            <option value="$2,500 – $5,000" {{ old('price_range')==='$2,500 – $5,000' ? 'selected' : ''
                                }}>$2,500 – $5,000</option>
                            <option value="$5,000+" {{ old('price_range')==='$5,000+' ? 'selected' : '' }}>$5,000+
                            </option>
                            <option value="To be discussed" {{ old('price_range')==='To be discussed' ? 'selected' : ''
                                }}>To be discussed</option>
                        </select>
                        @error('price_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Notes --}}
                <div style="margin-bottom:14px;">
                    <label class="form-label" for="notes">Additional Notes</label>
                    <textarea id="notes" name="notes" class="form-textarea"
                        placeholder="Number of guests, special requests, dietary needs...">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="form-submit" id="reservationSubmit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        <path
                            d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                    </svg>
                    Send via WhatsApp
                </button>

                <p
                    style="font-size:11px; color:rgba(255,255,255,0.3); text-align:center; margin-top:12px; line-height:1.6;">
                    This will open WhatsApp with your details pre-filled.<br>
                    Your request goes directly to our team.
                </p>
            </form>
        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
    document.getElementById('reservationForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('reservationSubmit');
    if (btn) {
        btn.textContent = 'Opening WhatsApp...';
        btn.disabled = true;
        btn.style.opacity = '0.7';
    }
});
</script>
@endpush