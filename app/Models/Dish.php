<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    protected $fillable = [
        'menu_day_id',
        'name_ar',
        'name_en',
        'price',
        'currency',
        'description',
        'is_available',
        'sort_order',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // ── Relationships ────────────────────────────────────────────

    public function day(): BelongsTo
    {
        return $this->belongsTo(MenuDay::class, 'menu_day_id');
    }

    // ── Helpers ──────────────────────────────────────────────────

    /**
     * Returns formatted price e.g. "$12"
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->currency . number_format($this->price, 0);
    }
}
