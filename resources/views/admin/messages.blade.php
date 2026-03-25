@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Contact Messages')
@section('content')

<div class="admin-page-header">
    <div>
        <h2 style="font-size:20px; font-weight:700; color:var(--dark);">Inbox</h2>
        <p style="font-size:13px; color:var(--light); margin-top:4px;">All contact form submissions</p>
    </div>
</div>

@forelse($messages as $msg)
<div class="msg-card {{ !$msg->is_read ? 'unread' : '' }}">

    {{-- Top row: name + date + unread dot --}}
    <div class="msg-card-top">
        <div class="msg-card-left">
            @if(!$msg->is_read)
            <div class="msg-unread-dot"></div>
            @endif
            <div>
                <div class="msg-name">{{ $msg->name }}</div>
                @if($msg->email)
                <div class="msg-email">{{ $msg->email }}</div>
                @endif
            </div>
        </div>
        <div class="msg-date">{{ $msg->created_at->format('M j, Y · g:i A') }}</div>
    </div>

    {{-- Meta row: phone + event type --}}
    <div class="msg-card-meta">
        <a href="tel:{{ $msg->phone }}" class="msg-phone">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 8.63 19.79 19.79 0 012 2.18 2 2 0 014 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14z" />
            </svg>
            {{ $msg->phone }}
        </a>
        @if($msg->event_type)
        <span class="admin-badge admin-badge-pink">{{ $msg->event_type }}</span>
        @endif
        @if($msg->event_date)
        <span class="msg-event-date">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            {{ $msg->event_date->format('M j, Y') }}
        </span>
        @endif
    </div>

    {{-- Message preview --}}
    <div class="msg-preview">{{ Str::limit($msg->message, 180) }}</div>

    {{-- Actions --}}
    <div class="msg-card-actions">
        <a href="{{ route('admin.messages.show', $msg) }}" class="admin-btn admin-btn-primary msg-view-btn">
            View Full Message
        </a>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank"
            class="admin-action-btn green">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                <path
                    d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
            </svg>
            WhatsApp
        </a>
        @if(!$msg->is_read)
        <form action="{{ route('admin.messages.read', $msg) }}" method="POST" style="display:inline;">
            @csrf @method('PATCH')
            <button type="submit" class="admin-action-btn">Mark Read</button>
        </form>
        @endif
        <form action="{{ route('admin.messages.delete', $msg) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Delete this message from {{ addslashes($msg->name) }}?')">
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
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
        </svg>
        <p>No messages yet.</p>
        <p style="font-size:12px; margin-top:4px;">Messages from the contact form will appear here.</p>
    </div>
</div>
@endforelse

@if($messages->hasPages())
<div style="margin-top:20px;">{{ $messages->links() }}</div>
@endif

@endsection