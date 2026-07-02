<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Approval ki jagah User model import kiya

class ApprovalController extends Controller
{
    public function index()
    {
        // Users table se sirf 'pending' users uthayein (Jo naye register huay hain)
        $pendingApprovals = User::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.approvals', compact('pendingApprovals'));
    }

    public function action(Request $request, $id)
    {
        $status = $request->input('status'); // approved ya rejected

        $user = User::findOrFail($id);

        if ($status === 'approved') {
            $user->update(['status' => 'approved']);
            return redirect()->back()->with('success', "User has been approved successfully!");
        } 
        
        if ($status === 'rejected') {
            $user->delete(); // Request reject hone par user delete ho jayega
            return redirect()->back()->with('success', "User request has been rejected!");
        }

        return redirect()->back();
    }
}