<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\MenuDay;
use App\Models\MenuWeek;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Create the current week ──────────────────────────────
        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY);

        $week = MenuWeek::create([
            'start_date' => $monday->toDateString(),
            'end_date'   => $monday->copy()->addDays(5)->toDateString(),
            'is_active'  => true,
            'note_ar'    => 'يقدم صحن سلطة أو لبن، تحلاية و سرفيس كامل مع كل وجبة',
            'note_en'    => 'Served with salad or yogurt, dessert & full service included',
        ]);

        // ── Real menu data from the client's image ───────────────
        $menuData = [
            [
                'day_name_en' => 'Monday',
                'day_name_ar' => 'الاثنين',
                'offset'      => 0,
                'dishes'      => [
                    ['name_ar' => 'فتّة بطحينة',   'price' => 10],
                    ['name_ar' => 'كبسة دجاج',      'price' => 12],
                    ['name_ar' => 'كبّبة بلبن',     'price' => 12],
                ],
            ],
            [
                'day_name_en' => 'Tuesday',
                'day_name_ar' => 'الثلاثاء',
                'offset'      => 1,
                'dishes'      => [
                    ['name_ar' => 'رز بل كاري',         'price' => 12],
                    ['name_ar' => 'خضار محشيّة',        'price' => 12],
                    ['name_ar' => 'بازيلا بلحمة و رز',  'price' => 12],
                ],
            ],
            [
                'day_name_en' => 'Wednesday',
                'day_name_ar' => 'الأربعاء',
                'offset'      => 2,
                'dishes'      => [
                    ['name_ar' => 'كبّبة أرنبيّة',   'price' => 12],
                    ['name_ar' => 'كفتة بالصينية',   'price' => 12],
                    ['name_ar' => 'مجدرة',            'price' => 8],
                ],
            ],
            [
                'day_name_en' => 'Thursday',
                'day_name_ar' => 'الخميس',
                'offset'      => 3,
                'dishes'      => [
                    ['name_ar' => 'رز مع دجاج مكسيكي',    'price' => 12],
                    ['name_ar' => 'شيش برك',               'price' => 12],
                    ['name_ar' => 'ستروغونوف ع دجاج',      'price' => 12],
                ],
            ],
            [
                'day_name_en' => 'Friday',
                'day_name_ar' => 'الجمعة',
                'offset'      => 4,
                'dishes'      => [
                    ['name_ar' => 'كوسا و ورق عنب', 'price' => 12],
                    ['name_ar' => 'فريكة بلحمة',     'price' => 12],
                    ['name_ar' => 'داوود باشا',       'price' => 12],
                ],
            ],
            [
                'day_name_en' => 'Saturday',
                'day_name_ar' => 'السبت',
                'offset'      => 5,
                'dishes'      => [
                    ['name_ar' => 'فوارغ',         'price' => 13],
                    ['name_ar' => 'كروش',          'price' => 13],
                    ['name_ar' => 'مسقادم',        'price' => 13],
                    ['name_ar' => 'لسانات',        'price' => 11],
                    ['name_ar' => 'راس نيفا كامل', 'price' => 15],
                ],
            ],
        ];

        // ── Insert days and dishes ───────────────────────────────
        foreach ($menuData as $sortOrder => $dayData) {
            $day = MenuDay::create([
                'menu_week_id' => $week->id,
                'date'         => $monday->copy()->addDays($dayData['offset'])->toDateString(),
                'day_name_en'  => $dayData['day_name_en'],
                'day_name_ar'  => $dayData['day_name_ar'],
                'sort_order'   => $sortOrder,
            ]);

            foreach ($dayData['dishes'] as $dishOrder => $dish) {
                Dish::create([
                    'menu_day_id'  => $day->id,
                    'name_ar'      => $dish['name_ar'],
                    'price'        => $dish['price'],
                    'currency'     => '$',
                    'is_available' => true,
                    'sort_order'   => $dishOrder,
                ]);
            }
        }
    }
}