<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'phone'       => ['required', 'string', 'max:30'],
            'event_type'  => ['required', 'string', 'max:100'],
            'event_date'  => ['required', 'date'],
            'price_range' => ['required', 'string', 'max:100'],
        ]);

                $date = Carbon::parse($request->event_date)->format('F j, Y');
 
        $text  = "*New Reservation Request*\n\n";
        $text .= "*Name:* {$request->name}\n";
        $text .= "*Phone:* {$request->phone}\n";
        $text .= "*Event Type:* {$request->event_type}\n";
        $text .= "*Date:* {$date}\n";
        $text .= "*Budget:* {$request->price_range}\n";

        if ($request->filled('notes')) {
            $text .= "*Notes:* {$request->notes}\n";
        }

        // Encode for WhatsApp URL
        $waNumber  = '9613486616';
        $waMessage = urlencode($text);
        $waUrl     = "https://wa.me/{$waNumber}?text={$waMessage}";

        return redirect($waUrl);
    }
}