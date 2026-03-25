@extends('layouts.admin')
@section('title', 'Edit Week')
@section('page-title', 'Edit Week — ' . $week->formatted_label)
@section('content')

<div class="admin-page-header">
    <div>
        <a href="{{ route('admin.weeks.index') }}" class="admin-back-link">← Back to Weeks</a>
        <div style="display:flex; align-items:center; gap:10px; margin-top:8px;">
            <h2 style="font-size:20px; font-weight:700; color:var(--dark);">{{ $week->formatted_label }}</h2>
            @if($week->is_active)
            <span class="admin-badge admin-badge-green">Active</span>
            @else
            <span class="admin-badge admin-badge-gray">Inactive</span>
            @endif
        </div>
    </div>
    <a href="{{ route('menu.index') }}" target="_blank" class="admin-btn admin-btn-ghost">
        Preview Live ↗
    </a>
</div>

{{-- ── Week settings ─────────────────────────────────────────── --}}
<div class="admin-card" style="margin-bottom:32px;">
    <div class="admin-card-header">
        <div class="admin-card-title">Week Settings</div>
    </div>
    <div style="padding:24px;">
        <form action="{{ route('admin.weeks.update', $week) }}" method="POST">
            @csrf @method('PUT')
            <div class="admin-form-row cols-2">
                <div class="admin-form-field">
                    <label class="admin-label">Start Date *</label>
                    <input type="date" name="start_date" class="admin-input"
                        value="{{ $week->start_date->format('Y-m-d') }}" required />
                </div>
                <div class="admin-form-field">
                    <label class="admin-label">End Date *</label>
                    <input type="date" name="end_date" class="admin-input"
                        value="{{ $week->end_date->format('Y-m-d') }}" required />
                </div>
            </div>
            <div class="admin-form-row cols-2">
                <div class="admin-form-field">
                    <label class="admin-label">Footer Note (Arabic)</label>
                    <input type="text" name="note_ar" class="admin-input" dir="rtl" value="{{ $week->note_ar }}" />
                </div>
                <div class="admin-form-field">
                    <label class="admin-label">Footer Note (English)</label>
                    <input type="text" name="note_en" class="admin-input" value="{{ $week->note_en }}" />
                </div>
            </div>
            <div class="admin-form-field" style="margin-bottom:20px;">
                <label class="admin-checkbox-row">
                    <input type="checkbox" name="is_active" value="1" {{ $week->is_active ? 'checked' : '' }}/>
                    <span>Set as the <strong>active week</strong> (shown on website)</span>
                </label>
            </div>
            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Days & Dishes ─────────────────────────────────────────── --}}
<div style="margin-bottom:16px; display:flex; align-items:center; justify-content:space-between;">
    <h3 style="font-size:18px; font-weight:700; color:var(--dark);">Days & Dishes</h3>
    <span style="font-size:12px; color:var(--light);">Enter all dishes for a day and click Save</span>
</div>

<div class="admin-days-grid">
    @foreach($week->days as $day)
    <div class="admin-day-card {{ $day->is_today ? 'today' : '' }}">

        {{-- Day header --}}
        <div class="admin-day-header">
            <div>
                <div class="admin-day-name">
                    {{ $day->day_name_en }}
                    @if($day->is_today)
                    <span class="admin-badge admin-badge-pink" style="margin-left:8px;">Today</span>
                    @endif
                </div>
                <div class="admin-day-name-ar">{{ $day->day_name_ar }}</div>
            </div>
            <div class="admin-day-date">{{ $day->date->format('M j, Y') }}</div>
        </div>

        {{-- Existing dishes --}}
        @if($day->dishes->isNotEmpty())
        <div class="admin-dish-list">
            @foreach($day->dishes as $dish)
            <div class="admin-dish-row">
                <div class="admin-dish-name-ar">{{ $dish->name_ar }}</div>
                <div class="admin-dish-price">{{ $dish->formatted_price }}</div>
                <div class="admin-dish-actions">
                    <form action="{{ route('admin.dishes.destroy', [$week, $dish]) }}" method="POST"
                        onsubmit="return confirm('Remove {{ addslashes($dish->name_ar) }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="admin-dish-delete" title="Remove dish">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3,6 5,6 21,6" />
                                <path d="M19,6l-1,14H6L5,6" />
                                <path d="M9,6V4h6v2" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="admin-dish-empty">No dishes yet — add them below</div>
        @endif

        {{-- ── BULK ADD FORM ──────────────────────────────────── --}}
        <div class="admin-bulk-form">
            <div class="admin-bulk-form-header">
                <span>Add Dishes</span>
                <span style="font-size:11px; color:var(--light);">Fill rows and click Save All</span>
            </div>

            <form action="{{ route('admin.dishes.bulk', [$week, $day]) }}" method="POST" class="bulk-dish-form"
                id="bulk-form-{{ $day->id }}">
                @csrf

                <div class="admin-bulk-table">
                    {{-- Header --}}
                    <div class="admin-bulk-header">
                        <div>Dish Name (Arabic) *</div>
                        <div>Price ($) *</div>
                        <div></div>
                    </div>

                    {{-- Rows container --}}
                    <div class="admin-bulk-rows" id="rows-{{ $day->id }}">
                        @for($i = 0; $i < 3; $i++) <div class="admin-bulk-row">
                            <input type="text" name="dishes[{{ $i }}][name_ar]" class="admin-input-sm"
                                placeholder="مثال: كبّبة بلبن" dir="rtl" />

                            <input type="number" name="dishes[{{ $i }}][price]" class="admin-input-sm" placeholder="12"
                                step="0.5" min="0" />
                            <button type="button" class="remove-row-btn" onclick="removeRow(this)"
                                title="Remove row">×</button>
                    </div>
                    @endfor
                </div>
        </div>

        <div class="admin-bulk-actions">
            <button type="button" class="admin-btn admin-btn-ghost" onclick="addRow({{ $day->id }})">
                + Add Row
            </button>
            <button type="submit" class="admin-btn admin-btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20,6 9,17 4,12" />
                </svg>
                Save All Dishes
            </button>
        </div>
        </form>
    </div>
    {{-- ── END BULK FORM ─────────────────────────────────── --}}

</div>
@endforeach
</div>

@endsection

@push('scripts')
<script>
    // Track row counts per day
const rowCounts = {};

function getNextIndex(dayId) {
    const container = document.getElementById('rows-' + dayId);
    const rows = container.querySelectorAll('.admin-bulk-row');
    // Find the highest current index and increment
    let max = rows.length - 1;
    rows.forEach(row => {
        const input = row.querySelector('input[name*="[name_ar]"]');
        if (input) {
            const match = input.name.match(/dishes\[(\d+)\]/);
            if (match) max = Math.max(max, parseInt(match[1]));
        }
    });
    return max + 1;
}

function addRow(dayId) {
    const container = document.getElementById('rows-' + dayId);
    const idx = getNextIndex(dayId);

    const row = document.createElement('div');
    row.className = 'admin-bulk-row';
    row.innerHTML = `
        <input type="text" name="dishes[${idx}][name_ar]" class="admin-input-sm" placeholder="مثال: كبّبة بلبن" dir="rtl" />
        <input type="text" name="dishes[${idx}][name_en]" class="admin-input-sm" placeholder="Optional" />
        <input type="number" name="dishes[${idx}][price]" class="admin-input-sm" placeholder="12" step="0.5" min="0" />
        <button type="button" class="remove-row-btn" onclick="removeRow(this)" title="Remove">×</button>
    `;

    container.appendChild(row);
    // Focus the first input of the new row
    row.querySelector('input').focus();
}

function removeRow(btn) {
    const row = btn.closest('.admin-bulk-row');
    const container = row.parentElement;
    // Keep at least 1 row
    if (container.querySelectorAll('.admin-bulk-row').length > 1) {
        row.remove();
    } else {
        // Just clear the inputs
        row.querySelectorAll('input').forEach(i => i.value = '');
    }
}

// Prevent submit if all rows are empty
document.querySelectorAll('.bulk-dish-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const inputs = this.querySelectorAll('input[name*="[name_ar]"]');
        const hasValue = Array.from(inputs).some(i => i.value.trim() !== '');
        if (!hasValue) {
            e.preventDefault();
            alert('Please enter at least one dish name before saving.');
            return;
        }
        const btn = this.querySelector('.admin-btn-primary');
        if (btn) { btn.textContent = 'Saving...'; btn.disabled = true; }
    });
});
</script>
@endpush