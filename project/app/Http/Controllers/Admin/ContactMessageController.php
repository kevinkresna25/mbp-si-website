<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ContactMessageController extends Controller
{
    public function index()
    {
        // Gracefully handle if table doesn't exist yet
        if (!Schema::hasTable('contact_messages')) {
            $messages = collect();
            return view('admin.contact-messages.index', compact('messages'));
        }

        $messages = ContactMessage::latest()->paginate(20);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show($id)
    {
        if (!Schema::hasTable('contact_messages')) {
            return view('admin.contact-messages.show', ['message' => null]);
        }

        $message = ContactMessage::findOrFail($id);

        // Mark as read
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
                'read_at' => now(),
                'read_by' => Auth::id(),
            ]);
        }

        return view('admin.contact-messages.show', compact('message'));
    }

    public function toggleRead($id)
    {
        if (!Schema::hasTable('contact_messages')) {
            return redirect()->route('admin.contact-messages.index')
                ->with('info', 'Tabel contact_messages belum dibuat.');
        }

        $message = ContactMessage::findOrFail($id);

        $message->update([
            'is_read'  => !$message->is_read,
            'read_at'  => !$message->is_read ? now() : null,
            'read_by'  => !$message->is_read ? Auth::id() : null,
        ]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', $message->is_read ? 'Pesan ditandai sudah dibaca.' : 'Pesan ditandai belum dibaca.');
    }
}
