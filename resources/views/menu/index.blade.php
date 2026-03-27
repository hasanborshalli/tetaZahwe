@extends('layouts.app')
@section('title', 'Weekly Menu — Teta Zahwe Catering')
@section('description', "Browse this week's fresh homemade Lebanese menu. Updated every Monday.")
@section('content')

{{-- ── Page Hero (kept as-is) ─────────────────────────────────── --}}
<div class="menu-page-hero">
    <div class="menu-page-hero-bg">طبخات</div>
    <div class="menu-page-hero-inner">
        <div class="menu-page-logo-wrap">
            <img src="{{ asset('images/teta-zahwe-logo.jpg') }}" alt="Teta Zahwe" class="menu-page-logo" />
        </div>
        <div class="menu-page-hero-text">
            <div class="eyebrow" style="color:var(--pink);" data-reveal>Updated Every Week</div>
            <h1 class="menu-page-title" data-reveal data-delay="100">
                This Week's <em>Menu.</em>
            </h1>
            @if($week)
            <div class="menu-page-badge" data-reveal data-delay="200">
                {{ $week->start_date->format('M j') }} — {{ $week->end_date->format('M j, Y') }}
            </div>
            @endif
        </div>
    </div>
</div>

@if($week)

{{-- ── Week switcher ───────────────────────────────────────────── --}}
@if($allWeeks->count() > 1)
<div class="menu-week-switcher">
    <span class="menu-switcher-label">Browse weeks:</span>
    <div class="menu-switcher-pills">
        @foreach($allWeeks as $w)
        <a href="{{ route('menu.show', $w) }}"
            class="menu-switcher-pill {{ isset($week) && $week->id === $w->id ? 'active' : '' }}">
            {{ $w->start_date->format('M j') }} – {{ $w->end_date->format('M j') }}
            @if($w->is_active)<span class="menu-switcher-live">Live</span>@endif
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- ── Day Tabs ─────────────────────────────────────────────────── --}}
<div class="menu-tabs-section">

    {{-- Tab buttons --}}
    <div class="menu-tabs-nav" id="menuTabsNav">
        @foreach($week->days as $i => $day)
        <button
            class="menu-tab-btn {{ $day->is_today ? 'active' : ($i === 0 && !$week->days->contains('is_today', true) ? 'active' : '') }}"
            data-tab="day-{{ $day->id }}" onclick="switchTab(this, 'day-{{ $day->id }}')">
            <span class="menu-tab-num">{{ $day->date->format('j') }}</span>
            <span class="menu-tab-name">{{ $day->day_name_en }}</span>
            <span class="menu-tab-name-ar">{{ $day->day_name_ar }}</span>
            @if($day->is_today)
            <span class="menu-tab-today-dot"></span>
            @endif
        </button>
        @endforeach
    </div>

    {{-- Tab panels --}}
    <div class="menu-tabs-body">
        @foreach($week->days as $i => $day)
        <div class="menu-tab-panel {{ $day->is_today ? 'active' : ($i === 0 && !$week->days->contains('is_today', true) ? 'active' : '') }}"
            id="day-{{ $day->id }}" data-date="{{ $day->date->format('Y-m-d') }}">

            {{-- Panel header --}}
            <div class="menu-panel-header">
                <div class="menu-panel-day-bg">{{ $day->day_name_en }}</div>
                <div class="menu-panel-header-inner">
                    <div>
                        <div class="menu-panel-day-name">{{ $day->day_name_en }}</div>
                        <div class="menu-panel-date">{{ $day->date->format('F j, Y') }}</div>
                    </div>
                    <div class="menu-panel-ar">{{ $day->day_name_ar }}</div>
                    @if($day->is_today)
                    <div class="menu-panel-today">Today's Menu</div>
                    @endif
                </div>
            </div>

            {{-- Dishes grid --}}
            <div class="menu-dishes-grid">
                @forelse($day->dishes as $dish)
                <div class="menu-dish-card">
                    <div class="menu-dish-card-inner">
                        <div class="menu-dish-card-name">{{ $dish->name_ar }}</div>
                        @if($dish->name_en)
                        <div class="menu-dish-card-name-en">{{ $dish->name_en }}</div>
                        @endif
                        <div class="menu-dish-card-price">{{ $dish->formatted_price }}</div>
                    </div>
                </div>
                @empty
                <div class="menu-dishes-empty">
                    <p>Menu for this day is being updated.</p>
                </div>
                @endforelse
            </div>

            {{-- Day note --}}
            @if($week->note_ar)
            <div class="menu-panel-note">
                <div class="menu-panel-note-icon">🍽</div>
                <div>
                    <div class="menu-panel-note-ar">{{ $week->note_ar }}</div>
                    @if($week->note_en)
                    <div class="menu-panel-note-en">{{ $week->note_en }}</div>
                    @endif
                </div>
            </div>
            @endif

        </div>
        @endforeach
    </div>

</div>

{{-- ── Order CTA ────────────────────────────────────────────────── --}}
<div class="menu-order-cta">
    <div class="menu-order-cta-inner">
        <div class="menu-order-cta-left">
            <div class="eyebrow" style="color:var(--pink);">Ready to Order?</div>
            <h2 class="menu-order-title">Place your order<br>directly via <em>WhatsApp.</em></h2>
        </div>
        <div class="menu-order-cta-right">
            <a href="https://wa.me/9613486616" target="_blank" class="btn-whatsapp">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                    <path
                        d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                Order via WhatsApp
            </a>
            <a href="{{ route('reservation') }}" class="btn-primary">Book an Event</a>
        </div>
    </div>
</div>

@else

<div class="menu-empty-state">
    <img src="{{ asset('images/teta-zahwe-logo.jpg') }}" alt="Teta Zahwe"
        style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin:0 auto 24px;display:block;opacity:0.6;" />
    <h2 style="font-family:var(--font-display);font-size:28px;font-weight:700;color:var(--dark);margin-bottom:8px;">Menu
        coming soon.</h2>
    <p style="font-size:14px;color:var(--light);">Check back shortly or contact us directly.</p>
    <a href="{{ route('contact') }}" class="btn-primary" style="margin-top:24px;display:inline-flex;">Contact Us</a>
</div>

@endif

@endsection

@push('scripts')
<script>
    function switchTab(btn, panelId) {
    // Deactivate all tabs + panels
    document.querySelectorAll('.menu-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.menu-tab-panel').forEach(p => p.classList.remove('active'));
    // Activate clicked
    btn.classList.add('active');
    document.getElementById(panelId).classList.add('active');
}

// JS today check
const todayStr = new Date().toISOString().slice(0, 10);
document.querySelectorAll('.menu-tab-panel[data-date]').forEach(panel => {
    if (panel.dataset.date === todayStr) {
        // Deactivate all first
        document.querySelectorAll('.menu-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.menu-tab-panel').forEach(p => p.classList.remove('active'));
        // Activate today
        panel.classList.add('active');
        const tabBtn = document.querySelector(`[data-tab="${panel.id}"]`);
        if (tabBtn) tabBtn.classList.add('active');
    }
});
</script>
@endpush