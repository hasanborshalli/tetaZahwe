@extends('layouts.app')

@section('title', 'Weekly Menu — Teta Zahwe Catering')
@section('description', 'Browse this week\'s fresh homemade Lebanese menu. Updated every Monday.')

@section('content')

<div
    style="padding-top: 95px; background: var(--dark); min-height: 220px; display:flex; align-items:flex-end; padding-bottom:60px; padding-left:80px; padding-right:80px; position:relative; overflow:hidden;">
    <div
        style="position:absolute; top:50%; right:-40px; transform:translateY(-50%); font-family:var(--font-serif); font-size:300px; font-weight:900; font-style:italic; color:rgba(201,114,138,0.05); pointer-events:none;">
        Menu</div>
    <div style="position:relative; z-index:2;">
        <div class="eyebrow" style="color:var(--pink);" data-reveal>Updated Every Week</div>
        <h1 style="font-family:var(--font-serif); font-size:64px; font-weight:900; color:#fff; line-height:1; letter-spacing:-1px;"
            data-reveal data-delay="100">
            Weekly <em style="font-style:italic; color:var(--pink);">Menu.</em>
        </h1>
    </div>
</div>

<section class="menu-section" style="padding-top: 72px;">

    {{-- Week selector --}}
    @if($allWeeks->count() > 1)
    <div style="margin-bottom: 48px; display:flex; align-items:center; gap:12px; flex-wrap:wrap;" data-reveal>
        <span
            style="font-size:10px; font-weight:600; letter-spacing:3px; text-transform:uppercase; color:var(--light);">Browse:</span>
        @foreach($allWeeks as $w)
        <a href="{{ route('menu.show', $w) }}"
            style="padding: 8px 18px; font-size:10px; font-weight:600; letter-spacing:2px; text-transform:uppercase; border-radius:var(--radius); border: 1px solid {{ $week && $w->id === $week->id ? 'var(--pink)' : 'var(--line)' }}; background: {{ $week && $w->id === $week->id ? 'var(--pink)' : 'transparent' }}; color: {{ $week && $w->id === $week->id ? '#fff' : 'var(--mid)' }}; transition: all 0.3s;">
            {{ $w->start_date->format('M j') }} – {{ $w->end_date->format('M j') }}
            @if($w->is_active) <span style="margin-left:4px; opacity:0.7;">(Current)</span> @endif
        </a>
        @endforeach
    </div>
    @endif

    @if($week)
    <div class="menu-header">
        <div class="menu-header-left">
            <div class="menu-week-badge">{{ $week->formatted_label }}</div>
        </div>
        <div>
            <div class="menu-note">
                {{ $week->note_ar }}
                <div class="menu-note-en">{{ $week->note_en }}</div>
            </div>
        </div>
    </div>

    <div class="week-grid" data-stagger>
        @foreach($week->days as $day)
        <div class="day-card {{ $day->is_today ? 'is-today' : '' }}" data-stagger-item
            data-date="{{ $day->date->format('Y-m-d') }}">
            <div class="day-num">{{ $day->date->format('j') }}</div>
            <div class="day-card-header">
                <div>
                    <div class="day-name">{{ $day->day_name_en }}</div>
                    @if($day->day_name_ar)
                    <div style="font-size:11px; color:var(--pink); direction:rtl; margin-top:2px;">{{ $day->day_name_ar
                        }}</div>
                    @endif
                    <div class="day-today-badge">Today</div>
                </div>
                <div class="day-date">{{ $day->date->format('M j') }}</div>
            </div>
            <div class="dish-list">
                @forelse($day->dishes as $dish)
                <div class="dish-row">
                    <div class="dish-price">{{ $dish->formatted_price }}</div>
                    <div class="dish-name">{{ $dish->name_ar }}</div>
                </div>
                @empty
                <div style="padding:16px 0; font-size:12px; color:var(--light); text-align:center;">
                    No dishes listed
                </div>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>

    <div class="menu-footer-note" data-reveal>
        <div class="menu-footer-icon">🍽</div>
        <div>
            <div class="menu-footer-ar">{{ $week->note_ar }}</div>
            <div class="menu-footer-en">{{ $week->note_en }}</div>
        </div>
    </div>

    @else
    <div style="text-align:center; padding:80px 0;">
        <h2 class="display">No menu available yet.</h2>
        <p class="body-text" style="text-align:center; margin-top:12px;">Check back soon or contact us directly.</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="margin-top:24px; display:inline-block;">Contact
            Us</a>
    </div>
    @endif

</section>

{{-- Order CTA --}}
<section style="background:var(--dark); padding:80px; text-align:center;">
    <h2 style="font-family:var(--font-serif); font-size:44px; font-weight:900; color:#fff; margin-bottom:16px;"
        data-reveal>
        Ready to <em style="font-style:italic; color:var(--pink);">order?</em>
    </h2>
    <p style="font-size:13px; color:rgba(255,255,255,0.4); margin-bottom:36px; max-width:400px; margin-left:auto; margin-right:auto; line-height:2;"
        data-reveal data-delay="100">
        Contact us via WhatsApp or the contact form and we'll confirm your order right away.
    </p>
    <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;" data-reveal data-delay="200">
        <a href="https://wa.me/9613486616" target="_blank" class="btn-primary">Order via WhatsApp</a>
        <a href="{{ route('contact') }}" class="btn-primary">Send a Message</a>
    </div>
</section>

@endsection