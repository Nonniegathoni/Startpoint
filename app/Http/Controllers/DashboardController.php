<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        // Redirect admin users to admin dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // For other users, show the regular dashboard
        return view('dashboard')->with('header', 'Dashboard');
    }

    /**
     * Display the admin dashboard.
     */
    public function admin(): View
    {
        return view('admin.dashboard')->with('header', 'Admin Dashboard');
    }

    /**
     * Get admin dashboard data.
     */
    private function getAdminDashboard(): array
    {
        return [
            'totalUsers' => \App\Models\User::count(),
            'activeOpportunities' => \App\Models\Opportunity::where('is_active', true)->count(),
            'pendingApplications' => \App\Models\Application::where('status', 'pending')->count(),
            'activeInterns' => \App\Models\Intern::where('status', 'active')->count(),
        ];
    }

    /**
     * Get HR dashboard data.
     */
    private function getHrDashboard(): array
    {
        return [
            'totalApplicants' => \App\Models\User::where('user_type', 'applicant')->count(),
            'pendingReviews' => \App\Models\Application::where('status', 'pending')->count(),
            'activeInterns' => \App\Models\Intern::where('status', 'active')->count(),
            'departments' => \App\Models\Department::withCount('opportunities')->get(),
        ];
    }

    /**
     * Get supervisor dashboard data.
     */
    private function getSupervisorDashboard(): array
    {
        $user = auth()->user();
        return [
            'supervisedInterns' => \App\Models\Intern::where('supervisor_id', $user->id)->count(),
            'pendingReports' => \App\Models\ProgressReport::where('status', 'pending')->count(),
            'recentAssignments' => \App\Models\Assignment::where('department_id', $user->department_id)->latest()->take(5)->get(),
        ];
    }

    /**
     * Get applicant dashboard data.
     */
    private function getApplicantDashboard(): array
    {
        $user = auth()->user();
        return [
            'totalApplications' => $user->applications()->count(),
            'activeApplications' => $user->applications()->whereIn('status', ['pending', 'shortlisted'])->count(),
            'assignments' => $user->assignments()->count(),
            'progressReports' => $user->progressReports()->count(),
        ];
    }

    /**
     * Get department statistics.
     */
    private function getDepartmentStats(): array
    {
        return \App\Models\Department::withCount(['users', 'opportunities', 'interns'])->get()->toArray();
    }
}
