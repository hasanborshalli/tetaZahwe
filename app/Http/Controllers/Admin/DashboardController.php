<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\MenuWeek;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // ── Login ────────────────────────────────────────────────────

    public function loginForm()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $validEmail    = env('ADMIN_EMAIL', 'admin@tetazahwe.com');
        $validPassword = env('ADMIN_PASSWORD', 'TetaZahwe2025!');

        if ($request->email === $validEmail && $request->password === $validPassword) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    // ── Dashboard ────────────────────────────────────────────────

    public function index()
    {
        return view('admin.dashboard', [
            'activeWeek'     => MenuWeek::where('is_active', true)->with('days')->first(),
            'totalWeeks'     => MenuWeek::count(),
            'unreadCount'    => ContactMessage::where('is_read', false)->count(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }

    // ── Messages inbox ───────────────────────────────────────────

    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages', compact('messages'));
    }

    public function showMessage(ContactMessage $message)
    {
        // Auto-mark as read when opened
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.message-show', compact('message'));
    }

    public function markRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'Marked as read.');
    }

    public function deleteMessage(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages')->with('success', 'Message deleted.');
    }
}