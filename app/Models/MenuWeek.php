<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuWeek extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'label',
        'is_active',
        'note_ar',
        'note_en',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_active'  => 'boolean',
    ];

    // ── Relationships ────────────────────────────────────────────

    public function days(): HasMany
    {
        return $this->hasMany(MenuDay::class)->orderBy('sort_order');
    }

    // ── Scopes ───────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ── Helpers ──────────────────────────────────────────────────

    /**
     * Get the current active week with all days and dishes loaded.
     */
    public static function currentWeek(): ?self
    {
        return static::active()
            ->with(['days' => function ($q) {
                $q->orderBy('sort_order')
                  ->with(['dishes' => function ($q2) {
                      $q2->where('is_available', true)
                         ->orderBy('sort_order');
                  }]);
            }])
            ->latest()
            ->first();
    }

    /**
     * Auto-generate a readable label if none is manually set.
     * e.g. "Week of March 23 – 28, 2025"
     */
    public function getFormattedLabelAttribute(): string
    {
        if ($this->label) {
            return $this->label;
        }

        return 'Week of '
            . $this->start_date->format('F j')
            . ' – '
            . $this->end_date->format('j, Y');
    }
}
