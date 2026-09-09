<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resident;
use App\Models\Donation;
use App\Models\Volunteer;
use App\Models\EmergencyReport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function downloadResidentReport()
    {
        $residents = Resident::orderBy('name', 'asc')->get();
        $totalResidents = $residents->count();
        $criticalCount = $residents->where('medical_condition', 'Critical')->count();

        $pdf = Pdf::loadView('reports.resident_report', compact('residents', 'totalResidents', 'criticalCount'));

        return $pdf->download('monthly_resident_report.pdf');
    }

    public function downloadDonationReport()
    {
        // Sirf Current Month aur Current Year ki donations fetch karein
        $donations = Donation::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->orderBy('created_at', 'asc')
            ->get();

        // Start of Month aur Today/End of Month date set karein
        $startDate = now()->startOfMonth()->format('F 01, Y');
        $endDate = now()->format('F d, Y');

        // Current month ke total monetary funds calculate karein
        $totalMoneyDonations = $donations->where('donation_type', 'Money')->sum('amount');

        // PDF load karein
        $pdf = Pdf::loadView('reports.donation_report', compact('donations', 'startDate', 'endDate', 'totalMoneyDonations'));

        return $pdf->download('current_month_donation_report.pdf');
    }

    public function downloadVolunteerReport()
    {
        $volunteers = \App\Models\Volunteer::orderBy('tasks_completed', 'desc')->get();

        // Key Performance Metrics Calculate karein
        $totalVolunteers = $volunteers->count();
        $totalHours = $volunteers->sum('hours_this_month');
        $totalTasks = $volunteers->sum('tasks_completed');

        $pdf = Pdf::loadView('reports.volunteer_report', compact('volunteers', 'totalVolunteers', 'totalHours', 'totalTasks'));

        return $pdf->download('volunteer_activity_report.pdf');
    }

    public function downloadEmergencyReport()
    {
        // Relationships load karein (resident model se name aur room lene ke liye)
        $incidents = \App\Models\EmergencyReport::with('resident')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalIncidents = $incidents->count();
        $criticalCount = $incidents->filter(function ($item) {
            return strtolower($item->severity_level) == 'high' || strtolower($item->emergency_type) == 'cardiac arrest';
        })->count();

        $pdf = Pdf::loadView('reports.emergency_report', compact('incidents', 'totalIncidents', 'criticalCount'));

        return $pdf->download('emergency_incidents_report.pdf');
    }
}
