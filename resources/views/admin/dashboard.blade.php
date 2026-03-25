@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')

<div class="admin-stats-row">
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background:#FBF5F6;color:#C9728A;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <div class="admin-stat-num">{{ $totalWeeks }}</div>
            <div class="admin-stat-label">Total Weeks</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background:#f0fdf4;color:#22c55e;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12,6 12,12 16,14" />
            </svg>
        </div>
        <div>
            <div class="admin-stat-num">{{ $activeWeek ? '1' : '0' }}</div>
            <div class="admin-stat-label">Active Week</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background:#fff7ed;color:#f97316;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
            </svg>
        </div>
        <div>
            <div class="admin-stat-num">{{ $unreadCount }}</div>
            <div class="admin-stat-label">Unread Messages</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background:#fdf4ff;color:#a855f7;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
        </div>
        <div>
            <div class="admin-stat-num">{{ $activeWeek ? $activeWeek->days->count() : 0 }}</div>
            <div class="admin-stat-label">Days This Week</div>
        </div>
    </div>
</div>

<div class="admin-two-col">
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Active Week</div>
            <a href="{{ route('admin.weeks.index') }}" class="admin-card-action">Manage →</a>
        </div>
        @if($activeWeek)
        <div class="admin-active-week">
            <div class="admin-active-week-badge">LIVE</div>
            <div class="admin-active-week-label">{{ $activeWeek->formatted_label }}</div>
            <div class="admin-active-week-dates">{{ $activeWeek->start_date->format('F j') }} – {{
                $activeWeek->end_date->format('F j, Y') }}</div>
        </div>
        <a href="{{ route('admin.weeks.edit', $activeWeek) }}" class="admin-btn admin-btn-primary"
            style="margin-top:20px;display:inline-block;">Edit This Week's Menu</a>
        @else
        <div class="admin-empty">
            <p>No active week set.</p><a href="{{ route('admin.weeks.create') }}" class="admin-btn admin-btn-primary"
                style="margin-top:16px;display:inline-block;">Create First Week</a>
        </div>
        @endif
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Recent Messages</div>
            <a href="{{ route('admin.messages') }}" class="admin-card-action">View All →</a>
        </div>
        @forelse($recentMessages as $msg)
        <div class="admin-msg-row {{ !$msg->is_read ? 'unread' : '' }}">
            <div class="admin-msg-dot {{ !$msg->is_read ? 'active' : '' }}"></div>
            <div class="admin-msg-info">
                <div class="admin-msg-name">{{ $msg->name }}</div>
                <div class="admin-msg-meta">{{ $msg->phone }} · {{ $msg->event_type ?? 'General' }}</div>
            </div>
            <div class="admin-msg-time">{{ $msg->created_at->diffForHumans() }}</div>
        </div>
        @empty
        <div class="admin-empty">
            <p>No messages yet.</p>
        </div>
        @endforelse
    </div>
</div>

<div class="admin-card" style="margin-top:24px;">
    <div class="admin-card-header">
        <div class="admin-card-title">Quick Actions</div>
    </div>
    <div class="admin-quick-actions">
        <a href="{{ route('admin.weeks.create') }}" class="admin-quick-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            New Week
        </a>
        @if($activeWeek)
        <a href="{{ route('admin.weeks.edit', $activeWeek) }}" class="admin-quick-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            Edit Active Menu
        </a>
        @endif
        <a href="{{ route('admin.messages') }}" class="admin-quick-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
            </svg>
            View Messages
        </a>
        <a href="{{ route('menu.index') }}" target="_blank" class="admin-quick-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
            Preview Menu
        </a>
    </div>
</div>

@endsection