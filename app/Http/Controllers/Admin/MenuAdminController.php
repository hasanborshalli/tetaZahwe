<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\MenuDay;
use App\Models\MenuWeek;
use Illuminate\Http\Request;

class MenuAdminController extends Controller
{
    public function editDay(MenuWeek $week, MenuDay $day)
    {
        $day->load('dishes');
        return view('admin.days.edit', compact('week', 'day'));
    }

    public function updateDay(Request $request, MenuWeek $week, MenuDay $day)
    {
        $request->validate([
            'day_name_en' => 'required|string|max:20',
            'day_name_ar' => 'nullable|string|max:30',
        ]);
        $day->update($request->only('day_name_en', 'day_name_ar'));
        return back()->with('success', 'Day updated.');
    }

    /**
     * Bulk add multiple dishes for one day at once
     */
    public function bulkStoreDishes(Request $request, MenuWeek $week, MenuDay $day)
    {
        $request->validate([
            'dishes'           => 'required|array',
            'dishes.*.name_ar' => 'nullable|string|max:150',
            'dishes.*.price'   => 'nullable|numeric|min:0',
        ]);

        $sortOrder = $day->dishes()->count();
        $added     = 0;

        foreach ($request->dishes as $row) {
            if (empty(trim($row['name_ar'] ?? ''))) continue;

            Dish::create([
                'menu_day_id'  => $day->id,
                'name_ar'      => trim($row['name_ar']),
                'name_en'      => trim($row['name_en'] ?? ''),
                'price'        => $row['price'] ?? 0,
                'currency'     => '$',
                'is_available' => true,
                'sort_order'   => $sortOrder++,
            ]);
            $added++;
        }

        return back()->with('success', $added . ' dish(es) added to ' . $day->day_name_en . '.');
    }

    // Keep single add for quick use
    public function addDish(Request $request, MenuWeek $week, MenuDay $day)
    {
        $request->validate([
            'name_ar' => 'required|string|max:150',
            'price'   => 'required|numeric|min:0',
        ]);

        Dish::create([
            'menu_day_id'  => $day->id,
            'name_ar'      => $request->name_ar,
            'name_en'      => $request->name_en,
            'price'        => $request->price,
            'currency'     => '$',
            'is_available' => true,
            'sort_order'   => $day->dishes()->count(),
        ]);

        return back()->with('success', 'Dish added.');
    }

    public function updateDish(Request $request, MenuWeek $week, Dish $dish)
    {
        $request->validate([
            'name_ar' => 'required|string|max:150',
            'price'   => 'required|numeric|min:0',
        ]);

        $dish->update([
            'name_ar'      => $request->name_ar,
            'name_en'      => $request->name_en,
            'price'        => $request->price,
            'currency'     => '$',
            'is_available' => $request->boolean('is_available', true),
        ]);

        return back()->with('success', 'Dish updated.');
    }

    public function destroyDish(MenuWeek $week, Dish $dish)
    {
        $dish->delete();
        return back()->with('success', 'Dish removed.');
    }
}