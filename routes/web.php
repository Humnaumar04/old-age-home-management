<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\EmergencyController;
use App\Models\EmergencyReport;
use App\Models\Message;
use App\Http\Controllers\Resident\DashboardController as ResidentDashboardController;
use App\Http\Controllers\Resident\ComplaintController;
use App\Http\Controllers\Resident\HelpRequestController;
use App\Http\Controllers\Admin\ComplaintManagementController;
use App\Http\Controllers\Donor\DashboardController as DonorDashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Donor\DonationController as DonorDonationController;
use App\Http\Controllers\Family\DashboardController as FamilyDashboardController;
use App\Http\Controllers\Family\CommunicationController;
use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Admin\VolunteerManagementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CommunityMemberController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// =====================================================
// PUBLIC LOGIN — Staff, Resident, Donor, Family, Volunteer
// =====================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================================================
// ADMIN LOGIN — separate, unlisted route (kahin link nahi hoga)
// =====================================================
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');


// =====================================================
// ADMIN ROUTES — sirf role = admin access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        $totalResidents = \App\Models\Resident::count() ?: 0;
        $activeStaff = \App\Models\Staff::count() ?: 0;
        $registeredDonors = \App\Models\User::where('role', 'donor')->count() ?: 0;
        $emergencies = EmergencyReport::where('status', 'Pending')->count() ?: 0;
        $recentResidents = \App\Models\Resident::latest()->take(4)->get();
        $pendingApprovals = \App\Models\User::where('status', 'pending')->latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalResidents',
            'activeStaff',
            'registeredDonors',
            'emergencies',
            'recentResidents',
            'pendingApprovals'
        ));
    })->name('admin.dashboard');

    // Donations (Admin side)
    Route::get('/admin/donations', [DonationController::class, 'index'])->name('admin.donations.index');
    Route::get('/admin/donations/requirements', [DonationController::class, 'requirements'])->name('admin.donations.requirements');
    Route::post('/admin/donations/requirements', [DonationController::class, 'store'])->name('admin.donations.store');
    Route::match(['get', 'post'], '/admin/donations/received', [DonationController::class, 'receivedDonations'])->name('admin.donations.received');
    Route::get('/admin/donations/{id}/review', [DonationController::class, 'showReviewDonation'])->name('admin.donations.review');
    Route::post('/admin/donations/{id}/update-status', [DonationController::class, 'updateDonationStatus'])->name('admin.donations.update-status');
    Route::delete('/admin/donations/requirements/{id}', [DonationController::class, 'destroyRequirement'])->name('admin.requirements.destroy');

    // Staff Management
    Route::get('/admin/manage-staff', [StaffController::class, 'index'])->name('admin.manage_staff');
    Route::get('/admin/add-staff', [StaffController::class, 'create'])->name('admin.add_staff');
    Route::post('/admin/add-staff', [StaffController::class, 'store'])->name('admin.add_staff.store');
    Route::delete('/admin/manage-staff/{id}', [StaffController::class, 'destroy'])->name('admin.manage_staff.destroy');
    Route::get('/admin/manage-staff/{id}/edit', [StaffController::class, 'edit'])->name('admin.manage_staff.edit');
    Route::put('/admin/manage-staff/{id}', [StaffController::class, 'update'])->name('admin.manage_staff.update');

    // Resident Management
    Route::get('/admin/manage-residents', [ResidentController::class, 'index'])->name('admin.manage_residents');
    Route::get('/admin/add-resident', [ResidentController::class, 'create'])->name('admin.add_resident');
    Route::post('/admin/add-resident', [ResidentController::class, 'store'])->name('admin.residents.store');
    Route::get('/admin/residents/{id}/edit', [ResidentController::class, 'edit'])->name('admin.residents.edit');
    Route::put('/admin/residents/{id}', [ResidentController::class, 'update'])->name('admin.residents.update');
    Route::delete('/admin/residents/{id}', [ResidentController::class, 'destroy'])->name('admin.residents.destroy');

    // Complaints Management
    Route::get('/admin/manage-complaints', [ComplaintManagementController::class, 'index'])->name('admin.manage-complaints');
    Route::get('/admin/complaints/{id}', [ComplaintManagementController::class, 'show'])->name('admin.complaints.show');
    Route::post('/admin/complaints/resolve/{id}', [ComplaintManagementController::class, 'resolve'])->name('admin.complaints.resolve');
    Route::patch('/admin/requests/{id}', [ComplaintManagementController::class, 'updateRequest'])->name('admin.requests.update');

    // Approvals
    Route::get('/admin/approvals', [ApprovalController::class, 'index'])->name('admin.approvals');
    Route::post('/admin/approvals/{id}/action', [ApprovalController::class, 'action'])->name('admin.approvals.action');
    // Community Members
    Route::get('/admin/community-members', [CommunityMemberController::class, 'index'])->name('admin.community_members');
    Route::get('/admin/community-members/{id}/reset-password', [CommunityMemberController::class, 'showResetPassword'])->name('admin.community_members.reset_password.show');
    Route::put('/admin/community-members/{id}/reset-password', [CommunityMemberController::class, 'resetPassword'])->name('admin.community_members.reset_password');
    // Emergency Reports (Admin view)
    Route::get('/admin/emergency-reports', [EmergencyController::class, 'showReports'])->name('admin.emergency_reports');
    Route::patch('/admin/emergency-reports/{id}/resolve', [EmergencyController::class, 'resolve'])->name('admin.emergency.resolve');

    // Volunteer Management
    Route::get('/admin/volunteer-management', [VolunteerManagementController::class, 'index'])->name('admin.volunteer_management');
    Route::post('/admin/assign-task', [VolunteerManagementController::class, 'assignTask'])->name('admin.assignTask');

    // Communication (Admin side)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/communication', [CommunicationController::class, 'adminIndex'])->name('communication');
        Route::get('/communication/{userId}', [CommunicationController::class, 'adminChat'])->name('communication.chat');
        Route::post('/communication/{userId}', [CommunicationController::class, 'adminStore'])->name('communication.store');
        Route::delete('/communication/clear/{userId}', [CommunicationController::class, 'clearChat'])->name('communication.clear');
    });

    // Reports (PDF downloads)
    Route::get('/admin/reports/resident/download', [ReportController::class, 'downloadResidentReport'])->name('admin.reports.resident');
    Route::get('/admin/reports/donation/download', [ReportController::class, 'downloadDonationReport'])->name('admin.reports.donation');
    Route::get('/admin/reports/volunteer/download', [ReportController::class, 'downloadVolunteerReport'])->name('admin.reports.volunteer');
    Route::get('/admin/reports/emergency/download', [ReportController::class, 'downloadEmergencyReport'])->name('admin.reports.emergency');
});

// =====================================================
// STAFF ROUTES — sirf role = staff access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff/dashboard', function () {
        $totalResidents = \App\Models\Resident::count() ?: 0;
        $updatedToday = \App\Models\Resident::whereDate('updated_at', today())->count() ?: 0;
        $criticalCases = \App\Models\Resident::where('medical_condition', 'Critical')->count() ?: 0;
        $residents = \App\Models\Resident::latest()->get();

        return view('staff.dashboard', compact(
            'totalResidents',
            'updatedToday',
            'criticalCases',
            'residents'
        ));
    })->name('staff.dashboard');

    Route::get('/staff/resident/{id}/update-health', function ($id) {
        $resident = \App\Models\Resident::find($id);
        return view('staff.update-health', compact('resident'));
    })->name('staff.update_health');

    Route::post('/staff/resident/{id}/save-health', function (\Illuminate\Http\Request $request, $id) {
        $resident = \App\Models\Resident::findOrFail($id);

        try {
            $resident->update([
                'medical_condition' => $request->medical_condition,
            ]);
        } catch (\Exception $e) {
            // Fallback catch
        }

        DB::table('health_logs')->insert([
            'resident_id'        => $id,
            'bp_systolic'        => $request->bp_systolic,
            'bp_diastolic'       => $request->bp_diastolic,
            'sugar_level'        => $request->sugar_level,
            'body_temperature'   => $request->body_temperature,
            'pulse_rate'         => $request->pulse_rate,
            'oxygen_saturation'  => $request->oxygen_saturation,
            'logged_by_staff_id' => Auth::id() ?? 1,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        DB::table('daily_activities')->insert([
            'resident_id'       => $id,
            'breakfast'         => $request->act_breakfast,
            'morning_walk'      => $request->act_morning_walk,
            'lunch'             => $request->act_lunch,
            'medication_taken'  => $request->act_medication,
            'physical_therapy'  => $request->act_physical_therapy,
            'dinner'            => $request->act_dinner,
            'sleep_routine'     => $request->act_sleep_routine,
            'staff_notes'       => $request->staff_notes,
            'date'              => today()->toDateString(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return redirect()->route('staff.dashboard')->with('success', 'Health Record Saved Successfully!');
    })->name('staff.save_health');

    // Emergency reporting (Staff files it)
    Route::get('/staff/report-emergency', [EmergencyController::class, 'index'])->name('emergency.create');
    Route::post('/staff/report-emergency', [EmergencyController::class, 'store'])->name('emergency.store');
    Route::get('/staff/get-resident-room/{id}', [EmergencyController::class, 'getRoom'])->name('emergency.getRoom');
});


// =====================================================
// RESIDENT ROUTES — sirf role = resident access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/resident/dashboard', [ResidentDashboardController::class, 'index'])->name('resident.dashboard');
    Route::get('/resident/submit-complaint', [ComplaintController::class, 'create'])->name('resident.submit-complaint');
    Route::post('/resident/submit-complaint', [ComplaintController::class, 'store'])->name('complaint.store');
    Route::get('/resident/request-help', function () {
        return view('resident.request-help');
    })->name('resident.request-help');
    Route::post('/resident/request-help', [HelpRequestController::class, 'store'])->name('help.store');
    Route::get('/resident/complaints', [ComplaintController::class, 'index'])->name('resident.complaints');
    Route::get('/resident/my-requests', [HelpRequestController::class, 'myRequests'])->name('resident.my-requests');
});


// =====================================================
// DONOR ROUTES — sirf role = donor access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:donor'])->group(function () {
    Route::get('/donor/dashboard', [DonorDashboardController::class, 'index'])->name('donor.dashboard');
    Route::get('/donor/make-donation', [DonorDonationController::class, 'create'])->name('donor.make-donation');
    Route::post('/donor/make-donation', [DonorDonationController::class, 'store'])->name('donor.donation.store');
    Route::get('/donor/my-donations', [DonorDonationController::class, 'history'])->name('donor.my-donations');
});


// =====================================================
// FAMILY ROUTES — sirf role = family access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:family'])->group(function () {
    Route::get('/family/dashboard', [FamilyDashboardController::class, 'index'])->name('family.dashboard');

    Route::prefix('family')->name('family.')->group(function () {
        Route::get('/communication', [CommunicationController::class, 'index'])->name('communication');
        Route::post('/communication/send', [CommunicationController::class, 'store'])->name('communication.store');
        // Family side clear chat route
        Route::delete('/communication/clear', [CommunicationController::class, 'familyClearChat'])->name('communication.clear');
    });
});


// =====================================================
// VOLUNTEER ROUTES — sirf role = volunteer access kar sakta hai
// =====================================================
Route::middleware(['auth', 'role:volunteer'])->group(function () {
    Route::get('/volunteer/dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
    Route::post('/volunteer/tasks/{id}/complete', [VolunteerController::class, 'completeTask'])->name('volunteer.completeTask');
});
