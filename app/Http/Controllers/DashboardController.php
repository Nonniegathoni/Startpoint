<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Application;
use App\Models\Assignment;
use App\Models\ProgressReport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->isAdmin()) {
            $data = $this->getAdminDashboard();
        } elseif ($user->isHrOfficer()) {
            $data = $this->getHrDashboard();
        } elseif ($user->isSupervisor()) {
            $data = $this->getSupervisorDashboard();
        } else {
            $data = $this->getApplicantDashboard();
        }

        return view('dashboard', $data);
    }

    private function getAdminDashboard()
    {
        return [
            'totalOpportunities' => Opportunity::count(),
            'activeOpportunities' => Opportunity::where('is_active', true)->count(),
            'totalApplications' => Application::count(),
            'pendingApplications' => Application::where('status', 'pending')->count(),
            'totalInterns' => \App\Models\User::where('user_type', 'applicant')->count(),
            'recentApplications' => Application::with(['applicant', 'opportunity'])
                ->latest()
                ->take(5)
                ->get(),
            'recentOpportunities' => Opportunity::with('department')
                ->latest()
                ->take(5)
                ->get(),
            'notifications' => Notification::latest()->take(10)->get(),
        ];
    }

    private function getHrDashboard()
    {
        return [
            'totalApplications' => Application::count(),
            'pendingApplications' => Application::where('status', 'pending')->count(),
            'shortlistedApplications' => Application::where('status', 'shortlisted')->count(),
            'approvedApplications' => Application::where('status', 'approved')->count(),
            'recentApplications' => Application::with(['applicant', 'opportunity'])
                ->latest()
                ->take(10)
                ->get(),
            'departmentStats' => $this->getDepartmentStats(),
            'notifications' => Notification::latest()->take(10)->get(),
        ];
    }

    private function getSupervisorDashboard()
    {
        $departmentId = Auth::user()->department_id;

        return [
            'departmentInterns' => \App\Models\User::where('user_type', 'applicant')
                ->where('department_id', $departmentId)
                ->count(),
            'pendingReports' => ProgressReport::whereHas('intern', function ($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            })->whereNull('reviewed_at')->count(),
            'departmentAssignments' => Assignment::where('department_id', $departmentId)->count(),
            'recentReports' => ProgressReport::with('intern')
                ->whereHas('intern', function ($q) use ($departmentId) {
                    $q->where('department_id', $departmentId);
                })
                ->latest()
                ->take(5)
                ->get(),
            'departmentAssignments' => Assignment::where('department_id', $departmentId)
                ->latest()
                ->take(5)
                ->get(),
            'notifications' => Notification::where('user_id', Auth::id())
                ->latest()
                ->take(10)
                ->get(),
        ];
    }

    private function getApplicantDashboard()
    {
        $userId = Auth::id();

        return [
            'myApplications' => Application::where('applicant_id', $userId)->count(),
            'pendingApplications' => Application::where('applicant_id', $userId)
                ->where('status', 'pending')
                ->count(),
            'approvedApplications' => Application::where('applicant_id', $userId)
                ->where('status', 'approved')
                ->count(),
            'myAssignments' => Assignment::whereHas('interns', function ($q) use ($userId) {
                $q->where('intern_id', $userId);
            })->count(),
            'pendingReports' => ProgressReport::where('intern_id', $userId)
                ->whereNull('reviewed_at')
                ->count(),
            'recentApplications' => Application::with('opportunity')
                ->where('applicant_id', $userId)
                ->latest()
                ->take(5)
                ->get(),
            'myAssignments' => Assignment::whereHas('interns', function ($q) use ($userId) {
                $q->where('intern_id', $userId);
            })->latest()->take(5)->get(),
            'notifications' => Notification::where('user_id', $userId)
                ->latest()
                ->take(10)
                ->get(),
        ];
    }

    private function getDepartmentStats()
    {
        return \App\Models\Department::withCount(['users', 'opportunities'])
            ->get()
            ->map(function ($department) {
                $department->applications_count = Application::whereHas('opportunity', function ($q) use ($department) {
                    $q->where('department_id', $department->id);
                })->count();
                return $department;
            });
    }
}
