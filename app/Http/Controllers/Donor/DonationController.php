<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function create()
    {
        return view('donor.make-donation');
    }

    public function store(Request $request)
    {
        $rules = [
            'donation_type' => 'required|string',
            'visibility' => 'required|string',
        ];

        $messages = [
            'transaction_id.unique' => 'This transaction ID has already been submitted. Please check and enter the correct ID.',
        ];

        if ($request->donation_type == 'Money') {
            $rules['amount'] = 'required|numeric|min:1';
            $rules['payment_method'] = 'required|string';
            $rules['transaction_id'] = 'required|string|unique:donations,transaction_id';
        } else {
            $rules['item_name'] = 'required|string';
            $rules['quantity'] = 'required|string';
            $rules['delivery_method'] = 'required|string';
        }

        // Sirf rules pass karein, alag se messages dene ki zaroorat nahi
        $request->validate($rules, $messages);

        Donation::create([
            'user_id' => Auth::id(),
            'donation_type' => $request->donation_type,
            'amount' => $request->donation_type == 'Money' ? $request->amount : null,
            'payment_method' => $request->donation_type == 'Money' ? $request->payment_method : null,
            'transaction_id' => $request->donation_type == 'Money' ? $request->transaction_id : null,
            'item_name' => $request->donation_type != 'Money' ? $request->item_name : null,
            'quantity' => $request->donation_type != 'Money' ? $request->quantity : null,
            'delivery_method' => $request->donation_type != 'Money' ? $request->delivery_method : null,
            'message' => $request->message,
            'visibility' => $request->visibility,
            'status' => 'Pending',
        ]);

        return redirect()->route('donor.make-donation')->with('success', 'Donation submitted successfully! It is pending review.');
    }

    public function history()
    {
        $donations = Donation::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('donor.my-donations', compact('donations'));
    }
}
