<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resident; // Import models

class ReportController extends Controller
{
    public function downloadResidentReport()
    {
        // Data fetch karein
        $residents = Resident::all();

        // PDF load karein aur view file pass karein
        $pdf = Pdf::loadView('reports.resident_report', compact('residents'));

        // PDF download ka command
        return $pdf->download('monthly_resident_report.pdf');
    }
    public function downloadDonationReport()
    {
        // Yahan apne Donation model ka data fetch karein
        $donations = \App\Models\Donation::all();

        // PDF load karein
        $pdf = Pdf::loadView('reports.donation_report', compact('donations'));

        return $pdf->download('donation_and_funding_report.pdf');
    }
    public function downloadVolunteerReport()
    {
        // Agar aapke paas Volunteer model mojood hai
        $volunteers = \App\Models\Volunteer::all();

        $pdf = Pdf::loadView('reports.volunteer_report', compact('volunteers'));

        return $pdf->download('volunteer_activity_report.pdf');
    }
    public function downloadEmergencyReport()
    {
        // EmergencyReport model se data fetch karein
        $incidents = \App\Models\EmergencyReport::all();

        // PDF load karein aur emergency_report.blade.php pass karein
        $pdf = Pdf::loadView('reports.emergency_report', compact('incidents'));

        return $pdf->download('emergency_incidents_report.pdf');
    }
}
