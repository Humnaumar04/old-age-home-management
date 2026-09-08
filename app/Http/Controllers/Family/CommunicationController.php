<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommunicationController extends Controller
{
    // 1. Family ke liye view: Chat open hotay hi Admin ke bheje hue unread messages read mark ho jayenge
    public function index()
    {
        $userId = Auth::id();

        // Admin ke bheje hue unread messages ko is_read = true mark karein
        Message::where('user_id', $userId)
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::with('user')
            ->where('user_id', $userId)
            ->oldest()
            ->get();

        return view('family.communication', compact('messages'));
    }

    // 2. Family ki taraf se message store karna
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id'     => Auth::id(),
            'message'     => $request->message,
            'sender_type' => 'family',
            'is_read'     => false, // Admin ke liye unread rahega jab tak admin open na kare
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    // 3. Admin ke liye: Saare family members ki list dikhana (Unread message count ke sath)
    public function adminIndex()
    {
        $families = User::where('role', '!=', 'admin')
            ->whereHas('messages')
            ->with('resident')
            ->withCount(['messages as unread_count' => function ($query) {
                $query->where('sender_type', 'family')
                    ->where('is_read', false);
            }])
            ->get();

        return view('admin.communication_index', compact('families'));
    }

    // 4. Admin ke liye: Kisi specific family member ki chat open karna aur unke messages read mark karna
    public function adminChat($userId)
    {
        $selectedUser = User::findOrFail($userId);

        // Family ke bheje gaye unread messages ko read mark karein
        Message::where('user_id', $userId)
            ->where('sender_type', 'family')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::with('user')
            ->where('user_id', $userId)
            ->oldest()
            ->get();

        return view('admin.communication', compact('messages', 'selectedUser'));
    }

    // 5. Admin ki taraf se reply store karna
    public function adminStore(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id'     => $userId,
            'message'     => $request->message,
            'sender_type' => 'admin',
            'is_read'     => false, // Family ke liye unread rahega jab tak family member view na kare
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }

    // 6. Admin ke liye: Particular family member ki saari chat history delete karna
    public function clearChat($userId)
    {
        Message::where('user_id', $userId)->delete();

        return back()->with('success', 'Chat history cleared successfully!');
    }
    // Family ke liye apni chat history clear karne ka method
    public function familyClearChat()
    {
        Message::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Chat history cleared successfully!');
    }
}
