<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationRequirement;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        // Yeh main hub page dikhayega jahan 2 options (cards) honge
        return view('admin.manage-donations');
    }

    public function requirements()
    {
        // Yeh woh page hai jo abhi aapki screen par hai (Form + Table)
        $requirements = DonationRequirement::all();
        return view('admin.donation-requirements', compact('requirements'));
    }

    public function receivedDonations()
    {
        // Completed donations sirf pichle 30 dino ki aur Pending/Approved sabhi show hon gi
        $donations = Donation::where(function ($query) {
            $query->where('status', 'Completed')
                ->where('created_at', '>=', now()->subDays(30));
        })
            ->orWhereIn('status', ['Pending', 'Approved'])
            ->latest()
            ->get();

        return view('admin.received-donations', compact('donations'));
    }

    // 2. Single donation ki details review page par dikhane ke liye
    public function showReviewDonation($id)
    {
        $donation = Donation::with('user')->findOrFail($id);
        return view('admin.review-donation', compact('donation'));
    }

    // 3. Status update karne ke liye
    public function updateDonationStatus(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $donation->status = $request->status;
        $donation->save();

        return redirect()->route('admin.donations.received')->with('success', 'Donation status updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity_needed' => 'required|string|max:255',
            'urgency' => 'required|string',
            'status' => 'required|string',
        ]);

        DonationRequirement::create($request->all());

        return redirect()->back()->with('success', 'Requirement added successfully!');
    }

    // 4. Requirement delete karne ke liye
    public function destroyRequirement($id)
    {
        $requirement = DonationRequirement::findOrFail($id);
        $requirement->delete();

        return redirect()->back()->with('success', 'Requirement deleted successfully!');
    }
}
