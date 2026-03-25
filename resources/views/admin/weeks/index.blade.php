@extends('layouts.admin')
@section('title', 'Weekly Menus')
@section('page-title', 'Weekly Menus')
@section('content')

<div class="admin-page-header">
    <div>
        <h2 style="font-size:20px; font-weight:700; color:var(--dark);">All Weeks</h2>
        <p style="font-size:13px; color:var(--light); margin-top:4px;">
            {{ $weeks->total() }} week(s) — only one can be active at a time
        </p>
    </div>
    <a href="{{ route('admin.weeks.create') }}" class="admin-btn admin-btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        New Week
    </a>
</div>

@forelse($weeks as $week)
<div class="week-card">
    <div class="week-card-left">
        {{-- Status indicator --}}
        <div class="week-card-status {{ $week->is_active ? 'active' : '' }}"></div>

        <div class="week-card-info">
            <div class="week-card-label">{{ $week->formatted_label }}</div>
            <div class="week-card-dates">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                {{ $week->start_date->format('M j') }} – {{ $week->end_date->format('M j, Y') }}
            </div>
            <div class="week-card-meta">
                <span>{{ $week->days_count }} days</span>
                @if($week->is_active)
                <span class="admin-badge admin-badge-green" style="margin-left:8px;">Active</span>
                @else
                <span class="admin-badge admin-badge-gray" style="margin-left:8px;">Inactive</span>
                @endif
            </div>
        </div>
    </div>

    <div class="week-card-actions">
        <a href="{{ route('admin.weeks.edit', $week) }}" class="admin-btn admin-btn-primary">
            Edit Menu
        </a>
        <form action="{{ route('admin.weeks.destroy', $week) }}" method="POST"
            onsubmit="return confirm('Delete this week and all its dishes?')">
            @csrf @method('DELETE')
            <button type="submit" class="admin-action-btn danger">Delete</button>
        </form>
    </div>
</div>
@empty
<div class="admin-card">
    <div class="admin-empty">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
            style="color:var(--light); margin:0 auto 12px;">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <path d="M16 2v4M8 2v4M3 10h18" />
        </svg>
        <p>No weeks created yet.</p>
        <a href="{{ route('admin.weeks.create') }}" class="admin-btn admin-btn-primary"
            style="margin-top:16px; display:inline-flex;">
            Create First Week
        </a>
    </div>
</div>
@endforelse

@if($weeks->hasPages())
<div style="margin-top:20px;">{{ $weeks->links() }}</div>
@endif

@endsection