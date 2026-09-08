<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\DonationRequirement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        // Database se saari requirements fetch karna
        $requirements = DonationRequirement::all();

        // Counts calculate karna summary cards ke liye
        $foodCount = DonationRequirement::where('category', 'Food')->count();
        $clothesCount = DonationRequirement::where('category', 'Clothes')->count();
        $medicineCount = DonationRequirement::where('category', 'Medicine')->count();
        $moneyCount = DonationRequirement::where('category', 'Money')->count();

        // Dashboard view ko data ke sath return karna
        return view('donor.dashboard', compact('requirements', 'foodCount', 'clothesCount', 'medicineCount', 'moneyCount'));
    }
}
