<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\EmergencyController;
use App\Models\EmergencyReport;
use App\Http\Controllers\Resident\DashboardController;
use App\Http\Controllers\Resident\ComplaintController;
use App\Http\Controllers\Resident\HelpRequestController;
use App\Http\Controllers\Admin\ComplaintManagementController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- DASHBOARDS ROUTES ---
Route::middleware(['auth'])->group(function () {

    // Admin Dashboard Route
    Route::get('/admin/dashboard', function () {
        $totalResidents = \App\Models\Resident::count() ?: 0;
        $activeStaff = \App\Models\Staff::count() ?: 0;
        $registeredDonors = 0;

        // --- Yahan humne database se count nikal liya ---
        $emergencies = \App\Models\EmergencyReport::count() ?: 0;

        $recentResidents = \App\Models\Resident::latest()->take(4)->get();
        $pendingApprovals = \App\Models\User::where('status', 'pending')->latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalResidents',
            'activeStaff',
            'registeredDonors',
            'emergencies', // Yeh variable ab view mein chala gaya
            'recentResidents',
            'pendingApprovals'
        ));
    })->name('admin.dashboard');

    // Fully Functional Dynamic Staff Dashboard Route
    Route::get('/staff/dashboard', function () {
        $totalResidents = \App\Models\Resident::count() ?: 0;
        $updatedToday = \App\Models\Resident::whereDate('updated_at', today())->count() ?: 0;

        // 'medical_condition' column ke mutabiq critical cases count
        $criticalCases = \App\Models\Resident::where('medical_condition', 'Critical')->count() ?: 0;

        $residents = \App\Models\Resident::latest()->get();

        return view('staff.dashboard', compact(
            'totalResidents',
            'updatedToday',
            'criticalCases',
            'residents'
        ));
    })->name('staff.dashboard');
    // Staff Dashboard se link click hone par Update Health ka frontend page open karne ke liye
    Route::get('/staff/resident/{id}/update-health', function ($id) {
        $resident = \App\Models\Resident::find($id); // Agar ID nahi bhi milti tab bhi page crash na ho testing mein
        return view('staff.update-health', compact('resident'));
    })->name('staff.update_health');
    Route::post('/staff/resident/{id}/save-health', function (\Illuminate\Http\Request $request, $id) {
        // 1. Check if resident exists
        $resident = \App\Models\Resident::findOrFail($id);

        // 2. Update Resident Table Condition
        try {
            $resident->update([
                'medical_condition' => $request->medical_condition,
            ]);
        } catch (\Exception $e) {
            // Fallback catch
        }

        // 3. Health Logs Table Insert
        DB::table('health_logs')->insert([
            'resident_id'        => $id,
            'bp_systolic'        => $request->bp_systolic,
            'bp_diastolic'       => $request->bp_diastolic,
            'sugar_level'        => $request->sugar_level,
            'body_temperature'   => $request->body_temperature,
            'pulse_rate'         => $request->pulse_rate,
            'oxygen_saturation'  => $request->oxygen_saturation,
            'logged_by_staff_id' => Auth::id() ?? 1, // Intelephense ki bolti band!
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        // 4. Daily Activities Table Insert
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

    // Resident dashboard routes
    Route::get('/resident/dashboard', [DashboardController::class, 'index'])->name('resident.dashboard');
    Route::get('/resident/submit-complaint', function () {
        return view('resident.submit-complaint');
    });
    // Form dikhane ke liye
    Route::get('/resident/submit-complaint', [ComplaintController::class, 'create'])->name('resident.submit-complaint');

    // Jab button dabaye to data save karne ke liye
    Route::post('/resident/submit-complaint', [ComplaintController::class, 'store'])->name('complaint.store');
    Route::get('/resident/request-help', function () {
        return view('resident.request-help');
    })->name('resident.request-help');
    Route::post('/resident/request-help', [HelpRequestController::class, 'store'])->name('help.store');
    Route::get('/resident/complaints', [ComplaintController::class, 'index'])->name('resident.complaints');
    Route::get('/resident/my-requests', [HelpRequestController::class, 'myRequests'])->name('resident.my-requests');
    Route::get('/donor/dashboard', function () {
        return view('donor.dashboard');
    })->name('donor.dashboard');
    Route::get('/family/dashboard', function () {
        return view('family.dashboard');
    })->name('family.dashboard');
    Route::get('/volunteer/dashboard', function () {
        return view('volunteer.dashboard');
    })->name('volunteer.dashboard');

    // Staff Management Routes
    Route::get('/admin/manage-staff', [StaffController::class, 'index'])->name('admin.manage_staff');
    Route::get('/admin/add-staff', [StaffController::class, 'create'])->name('admin.add_staff');
    Route::post('/admin/add-staff', [StaffController::class, 'store'])->name('admin.add_staff.store');
    Route::delete('/admin/manage-staff/{id}', [StaffController::class, 'destroy'])->name('admin.manage_staff.destroy');
    Route::get('/admin/manage-staff/{id}/edit', [StaffController::class, 'edit'])->name('admin.manage_staff.edit');
    Route::put('/admin/manage-staff/{id}', [StaffController::class, 'update'])->name('admin.manage_staff.update');

    // Resident Management Routes
    Route::get('/admin/manage-residents', [ResidentController::class, 'index'])->name('admin.manage_residents');
    Route::get('/admin/add-resident', [ResidentController::class, 'create'])->name('admin.add_resident');
    Route::post('/admin/add-resident', [ResidentController::class, 'store'])->name('admin.residents.store');
    Route::get('/admin/residents/{id}/edit', [ResidentController::class, 'edit'])->name('admin.residents.edit');
    Route::put('/admin/residents/{id}', [ResidentController::class, 'update'])->name('admin.residents.update');
    Route::delete('/admin/residents/{id}', [ResidentController::class, 'destroy'])->name('admin.residents.destroy');
    // Admin manages complaints
    Route::get('/admin/manage-complaints', function () {
        return view('admin.manage-complaints');
    });
    Route::get('/admin/manage-complaints', [ComplaintManagementController::class, 'index'])->name('admin.manage-complaints');
    Route::get('/admin/complaints/{id}', [ComplaintManagementController::class, 'show'])->name('admin.complaints.show');
    Route::post('/admin/complaints/resolve/{id}', [App\Http\Controllers\Admin\ComplaintManagementController::class, 'resolve']);
    Route::patch('/admin/requests/{id}', [ComplaintManagementController::class, 'updateRequest'])->name('admin.requests.update');

    // Approvals
    Route::get('/admin/approvals', [ApprovalController::class, 'index'])->name('admin.approvals');
    Route::post('/admin/approvals/{id}/action', [ApprovalController::class, 'action'])->name('admin.approvals.action');
    // 1. Form show karne aur residents data fetch karne ke liye (GET)
    Route::get('/staff/report-emergency', [EmergencyController::class, 'index'])->name('emergency.create');

    // 2. Form data submit kar ke save karne ke liye (POST)
    Route::post('/staff/report-emergency', [EmergencyController::class, 'store'])->name('emergency.store');
    // Resident ka room number fetch karne ke liye (AJAX Route)
    Route::get('/staff/get-resident-room/{id}', [EmergencyController::class, 'getRoom'])->name('emergency.getRoom');
    Route::get('/admin/emergency-reports', [EmergencyController::class, 'showReports'])->name('admin.emergency_reports');
});

// Authentication Registration Links
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
