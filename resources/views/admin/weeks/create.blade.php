@extends('layouts.admin')
@section('title', 'New Week')
@section('page-title', 'Create New Week')
@section('content')

<div class="admin-page-header">
    <a href="{{ route('admin.weeks.index') }}" class="admin-back-link">← Back to Weeks</a>
</div>

<div class="admin-card" style="max-width:640px;">
    <form action="{{ route('admin.weeks.store') }}" method="POST">
        @csrf

        <div class="admin-form-row">
            <div class="admin-form-field">
                <label class="admin-label">Start Date (Monday) *</label>
                <input type="date" name="start_date"
                    class="admin-input {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                    value="{{ old('start_date') }}" required />
                @error('start_date')<div class="admin-invalid">{{ $message }}</div>@enderror
            </div>
            <div class="admin-form-field">
                <label class="admin-label">End Date (Saturday) *</label>
                <input type="date" name="end_date"
                    class="admin-input {{ $errors->has('end_date') ? 'is-invalid' : '' }}" value="{{ old('end_date') }}"
                    required />
                @error('end_date')<div class="admin-invalid">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="admin-form-field">
            <label class="admin-label">Week Label (optional)</label>
            <input type="text" name="label" class="admin-input" value="{{ old('label') }}"
                placeholder="e.g. Week of March 23 – 28, 2025" />
            <div class="admin-hint">Leave blank to auto-generate from the dates.</div>
        </div>

        <div class="admin-form-field">
            <label class="admin-label">Footer Note (Arabic)</label>
            <input type="text" name="note_ar" class="admin-input" dir="rtl"
                value="{{ old('note_ar', 'يقدم صحن سلطة أو لبن، تحلاية و سرفيس كامل مع كل وجبة') }}" />
        </div>

        <div class="admin-form-field">
            <label class="admin-label">Footer Note (English)</label>
            <input type="text" name="note_en" class="admin-input"
                value="{{ old('note_en', 'Served with salad or yogurt, dessert & full service included') }}" />
        </div>

        <div class="admin-form-field">
            <label class="admin-checkbox-row">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} />
                <span>Set as the active week (shows on homepage & menu page)</span>
            </label>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn-primary">Create Week & Add Dishes →</button>
            <a href="{{ route('admin.weeks.index') }}" class="admin-btn admin-btn-ghost">Cancel</a>
        </div>
    </form>
</div>

@endsection