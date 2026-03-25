<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuDay extends Model
{
    protected $fillable = [
        'menu_week_id',
        'date',
        'day_name_en',
        'day_name_ar',
        'sort_order',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // ── Relationships ────────────────────────────────────────────

    public function week(): BelongsTo
    {
        return $this->belongsTo(MenuWeek::class, 'menu_week_id');
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class)->orderBy('sort_order');
    }

    // ── Helpers ──────────────────────────────────────────────────

    /**
     * Dynamically check if this day is today.
     * Used to highlight the active day card in the menu.
     */
    public function getIsTodayAttribute(): bool
    {
        return $this->date->isToday();
    }
}
