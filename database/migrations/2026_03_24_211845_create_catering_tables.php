<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Menu Weeks ───────────────────────────────────────────
        Schema::create('menu_weeks', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('label')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('note_ar')->nullable();
            $table->string('note_en')->nullable();
            $table->timestampsTz();
        });

        // ── Menu Days ────────────────────────────────────────────
        Schema::create('menu_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_week_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('day_name_en');
            $table->string('day_name_ar')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();
        });

        // ── Dishes ───────────────────────────────────────────────
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_day_id')->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('currency')->default('$');
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestampsTz();
        });

        // ── Contact Messages ─────────────────────────────────────
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('event_type')->nullable();
            $table->date('event_date')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('dishes');
        Schema::dropIfExists('menu_days');
        Schema::dropIfExists('menu_weeks');
    }
};