@extends('layouts.admin')
@section('title', 'Message from ' . $message->name)
@section('page-title', 'Message Detail')
@section('content')

<div class="admin-page-header">
    <a href="{{ route('admin.messages') }}" class="admin-back-link">← Back to Messages</a>
</div>

<div style="display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start;">

    {{-- Main message card --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="admin-card-title">Message</div>
                @if(!$message->is_read)
                <span class="admin-badge admin-badge-pink">Unread</span>
                @else
                <span class="admin-badge admin-badge-gray">Read</span>
                @endif
            </div>
            <div style="font-size:12px; color:var(--light);">
                {{ $message->created_at->format('l, F j, Y · g:i A') }}
            </div>
        </div>

        {{-- Full message text --}}
        <div style="padding:28px 28px 24px;">
            <div style="font-size:15px; line-height:1.9; color:var(--dark); white-space:pre-wrap;">{{ $message->message
                }}</div>
        </div>

        {{-- Actions --}}
        <div
            style="padding:0 28px 28px; display:flex; gap:12px; flex-wrap:wrap; border-top:1px solid var(--line); padding-top:20px; margin-top:4px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank"
                class="admin-btn admin-btn-primary" style="background:#25d366;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                    <path
                        d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.116 1.522 5.845L.057 23.928a.5.5 0 00.596.617l6.282-1.634A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.662-.523-5.17-1.432l-.37-.222-3.83.996.993-3.691-.243-.386A9.94 9.94 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                Reply on WhatsApp
            </a>
            @if($message->email)
            <a href="mailto:{{ $message->email }}" class="admin-btn admin-btn-ghost">
                Send Email
            </a>
            @endif
            <form action="{{ route('admin.messages.delete', $message) }}" method="POST"
                onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-action-btn danger" style="padding:9px 16px;">
                    Delete Message
                </button>
            </form>
        </div>
    </div>

    {{-- Sidebar: sender info --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Sender --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">Sender</div>
            </div>
            <div style="padding:20px;">
                <div class="msg-detail-field">
                    <div class="msg-detail-label">Name</div>
                    <div class="msg-detail-value">{{ $message->name }}</div>
                </div>
                <div class="msg-detail-field">
                    <div class="msg-detail-label">Phone</div>
                    <div class="msg-detail-value">
                        <a href="tel:{{ $message->phone }}" style="color:var(--pink);">{{ $message->phone }}</a>
                    </div>
                </div>
                @if($message->email)
                <div class="msg-detail-field">
                    <div class="msg-detail-label">Email</div>
                    <div class="msg-detail-value">
                        <a href="mailto:{{ $message->email }}" style="color:var(--pink);">{{ $message->email }}</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Event info --}}
        @if($message->event_type || $message->event_date)
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">Event Details</div>
            </div>
            <div style="padding:20px;">
                @if($message->event_type)
                <div class="msg-detail-field">
                    <div class="msg-detail-label">Event Type</div>
                    <div class="msg-detail-value">
                        <span class="admin-badge admin-badge-pink">{{ $message->event_type }}</span>
                    </div>
                </div>
                @endif
                @if($message->event_date)
                <div class="msg-detail-field">
                    <div class="msg-detail-label">Preferred Date</div>
                    <div class="msg-detail-value">{{ $message->event_date->format('F j, Y') }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Received --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">Received</div>
            </div>
            <div style="padding:20px;">
                <div class="msg-detail-value">{{ $message->created_at->format('F j, Y') }}</div>
                <div class="msg-detail-label" style="margin-top:4px;">{{ $message->created_at->format('g:i A') }} · {{
                    $message->created_at->diffForHumans() }}</div>
            </div>
        </div>

    </div>
</div>

@endsection