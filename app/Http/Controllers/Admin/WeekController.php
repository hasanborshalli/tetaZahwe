<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuDay;
use App\Models\MenuWeek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    public function index()
    {
        $weeks = MenuWeek::withCount('days')->orderByDesc('start_date')->paginate(10);
        return view('admin.weeks.index', compact('weeks'));
    }

    public function create()
    {
        return view('admin.weeks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'note_ar'    => 'nullable|string|max:300',
            'note_en'    => 'nullable|string|max:300',
        ]);

        // Deactivate all other weeks if this one is set as active
        if ($request->boolean('is_active')) {
            MenuWeek::query()->update(['is_active' => false]);
        }

        $week = MenuWeek::create([
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'label'      => $request->label,
            'is_active'  => $request->boolean('is_active'),
            'note_ar'    => $request->note_ar ?? 'يقدم صحن سلطة أو لبن، تحلاية و سرفيس كامل مع كل وجبة',
            'note_en'    => $request->note_en ?? 'Served with salad or yogurt, dessert & full service included',
        ]);

        // Auto-create one day entry per date in the range
        $this->generateDays($week);

        return redirect()
            ->route('admin.weeks.edit', $week)
            ->with('success', 'Week created! Now add dishes to each day.');
    }

    public function edit(MenuWeek $week)
    {
        $week->load(['days.dishes']);
        return view('admin.weeks.edit', compact('week'));
    }

    public function update(Request $request, MenuWeek $week)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'note_ar'    => 'nullable|string|max:300',
            'note_en'    => 'nullable|string|max:300',
        ]);

        if ($request->boolean('is_active')) {
            MenuWeek::where('id', '!=', $week->id)->update(['is_active' => false]);
        }

        $week->update([
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'label'      => $request->label,
            'is_active'  => $request->boolean('is_active'),
            'note_ar'    => $request->note_ar,
            'note_en'    => $request->note_en,
        ]);

        return back()->with('success', 'Week updated successfully.');
    }

    public function destroy(MenuWeek $week)
    {
        $week->delete(); // cascades to days and dishes
        return redirect()->route('admin.weeks.index')->with('success', 'Week deleted.');
    }

    // ── Helpers ──────────────────────────────────────────────────

    private function generateDays(MenuWeek $week): void
    {
        $namesEn = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $namesAr = ['الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'];

        $current = Carbon::parse($week->start_date);
        $end     = Carbon::parse($week->end_date);
        $order   = 0;

        while ($current->lte($end)) {
            // Carbon: 0=Sunday, 1=Monday ... 6=Saturday
            $dow = $current->dayOfWeek;
            $idx = ($dow === 0) ? 6 : $dow - 1;

            MenuDay::create([
                'menu_week_id' => $week->id,
                'date'         => $current->toDateString(),
                'day_name_en'  => $namesEn[$idx],
                'day_name_ar'  => $namesAr[$idx],
                'sort_order'   => $order++,
            ]);

            $current->addDay();
        }
    }
}
