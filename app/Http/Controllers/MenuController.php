<?php

namespace App\Http\Controllers;

use App\Models\MenuWeek;

class MenuController extends Controller
{
    public function index()
    {
        $week     = MenuWeek::currentWeek();
        $allWeeks = MenuWeek::orderByDesc('start_date')->get();

        return view('menu.index', compact('week', 'allWeeks'));
    }

    public function show(MenuWeek $week)
    {
        $week->load(['days' => function ($q) {
            $q->orderBy('sort_order')
              ->with(['dishes' => fn ($q2) => $q2->where('is_available', true)->orderBy('sort_order')]);
        }]);

        $allWeeks = MenuWeek::orderByDesc('start_date')->get();

        return view('menu.index', compact('week', 'allWeeks'));
    }
}
