<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WeekController;
use App\Http\Controllers\Admin\MenuAdminController;
use Illuminate\Support\Facades\Route;

// ================================================================
// PUBLIC ROUTES
// ================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/menu',        [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{week}', [MenuController::class, 'show'])->name('menu.show');

// QR code always redirects to the live menu
Route::get('/qr', fn () => redirect()->route('menu.index'))->name('qr');

// Contact — simple message form
Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Reservation — sends via WhatsApp
Route::get('/reservation',  [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'send'])->name('reservation.send');

// ================================================================
// ADMIN ROUTES
// ================================================================

// Login is public (outside middleware)
Route::get('/admin/login',   [DashboardController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login',  [DashboardController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [DashboardController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth.admin')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Weeks CRUD
        Route::get('/weeks',             [WeekController::class, 'index'])->name('weeks.index');
        Route::get('/weeks/create',      [WeekController::class, 'create'])->name('weeks.create');
        Route::post('/weeks',            [WeekController::class, 'store'])->name('weeks.store');
        Route::get('/weeks/{week}/edit', [WeekController::class, 'edit'])->name('weeks.edit');
        Route::put('/weeks/{week}',      [WeekController::class, 'update'])->name('weeks.update');
        Route::delete('/weeks/{week}',   [WeekController::class, 'destroy'])->name('weeks.destroy');

        // Days & Dishes nested under a week
        Route::prefix('weeks/{week}')->group(function () {
            Route::get('/days/{day}/edit',         [MenuAdminController::class, 'editDay'])->name('days.edit');
            Route::put('/days/{day}',              [MenuAdminController::class, 'updateDay'])->name('days.update');
            Route::post('/days/{day}/dishes',      [MenuAdminController::class, 'addDish'])->name('dishes.store');
            Route::post('/days/{day}/dishes/bulk', [MenuAdminController::class, 'bulkStoreDishes'])->name('dishes.bulk');
            Route::put('/dishes/{dish}',           [MenuAdminController::class, 'updateDish'])->name('dishes.update');
            Route::delete('/dishes/{dish}',        [MenuAdminController::class, 'destroyDish'])->name('dishes.destroy');
        });

        // Contact messages inbox
        Route::get('/messages',                  [DashboardController::class, 'messages'])->name('messages');
        Route::get('/messages/{message}',        [DashboardController::class, 'showMessage'])->name('messages.show');
        Route::patch('/messages/{message}/read', [DashboardController::class, 'markRead'])->name('messages.read');
        Route::delete('/messages/{message}',     [DashboardController::class, 'deleteMessage'])->name('messages.delete');
    });