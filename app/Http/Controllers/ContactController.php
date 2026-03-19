<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $user = $request->user();

        ContactMessage::create([
            'user_id' => $user?->id,
            'sender_name' => $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : ($validated['name'] ?? null),
            'sender_email' => $user?->email ?? ($validated['email'] ?? null),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return back()->with('status', 'Message sent successfully!');
    }
}
