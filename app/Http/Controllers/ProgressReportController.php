<?php

namespace App\Http\Controllers;

use App\Models\ProgressReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressReportController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgressReport::with(['intern', 'reviewer']);

        // Filter by user type
        if (Auth::user()->isApplicant()) {
            $query->where('intern_id', Auth::id());
        } elseif (Auth::user()->isSupervisor()) {
            // Supervisors can see reports from interns in their department
            $query->whereHas('intern', function ($q) {
                $q->where('department_id', Auth::user()->department_id);
            });
        }

        // Filter by report type
        if ($request->filled('report_type')) {
            $query->where('report_type', $request->report_type);
        }

        // Filter by status (reviewed/unreviewed)
        if ($request->filled('reviewed')) {
            if ($request->reviewed === 'true') {
                $query->whereNotNull('reviewed_at');
            } else {
                $query->whereNull('reviewed_at');
            }
        }

        $reports = $query->latest()->paginate(15);

        return view('progress-reports.index', compact('reports'));
    }

    public function create()
    {
        // Only interns can create progress reports
        if (!Auth::user()->isApplicant()) {
            abort(403);
        }

        return view('progress-reports.create');
    }

    public function store(Request $request)
    {
        // Only interns can create progress reports
        if (!Auth::user()->isApplicant()) {
            abort(403);
        }

        $validated = $request->validate([
            'report_type' => 'required|in:weekly,monthly',
            'report_period_start' => 'required|date',
            'report_period_end' => 'required|date|after:report_period_start',
            'tasks_completed' => 'required|string',
            'challenges_faced' => 'nullable|string',
            'lessons_learned' => 'nullable|string',
            'next_week_goals' => 'nullable|string',
        ]);

        $report = ProgressReport::create([
            ...$validated,
            'intern_id' => Auth::id(),
            'submitted_at' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('progress-reports.show', $report)
            ->with('success', 'Progress report submitted successfully!');
    }

    public function show(ProgressReport $progressReport)
    {
        // Check permissions
        if (Auth::user()->isApplicant() && $progressReport->intern_id !== Auth::id()) {
            abort(403);
        }

        if (Auth::user()->isSupervisor()) {
            $intern = User::find($progressReport->intern_id);
            if ($intern->department_id !== Auth::user()->department_id) {
                abort(403);
            }
        }

        $progressReport->load(['intern', 'reviewer']);

        return view('progress-reports.show', compact('progressReport'));
    }

    public function edit(ProgressReport $progressReport)
    {
        // Only interns can edit their own reports
        if (Auth::user()->isApplicant() && $progressReport->intern_id !== Auth::id()) {
            abort(403);
        }

        // Can't edit if already reviewed
        if ($progressReport->reviewed_at) {
            return redirect()->route('progress-reports.show', $progressReport)
                ->with('error', 'Cannot edit report that has been reviewed.');
        }

        return view('progress-reports.edit', compact('progressReport'));
    }

    public function update(Request $request, ProgressReport $progressReport)
    {
        // Only interns can update their own reports
        if (Auth::user()->isApplicant() && $progressReport->intern_id !== Auth::id()) {
            abort(403);
        }

        // Can't update if already reviewed
        if ($progressReport->reviewed_at) {
            return redirect()->route('progress-reports.show', $progressReport)
                ->with('error', 'Cannot update report that has been reviewed.');
        }

        $validated = $request->validate([
            'report_type' => 'required|in:weekly,monthly',
            'report_period_start' => 'required|date',
            'report_period_end' => 'required|date|after:report_period_start',
            'tasks_completed' => 'required|string',
            'challenges_faced' => 'nullable|string',
            'lessons_learned' => 'nullable|string',
            'next_week_goals' => 'nullable|string',
        ]);

        $progressReport->update($validated);

        return redirect()->route('progress-reports.show', $progressReport)
            ->with('success', 'Progress report updated successfully!');
    }

    public function review(Request $request, ProgressReport $progressReport)
    {
        // Only supervisors can review reports
        if (!Auth::user()->isSupervisor()) {
            abort(403);
        }

        // Check if supervisor is in the same department as the intern
        $intern = User::find($progressReport->intern_id);
        if ($intern->department_id !== Auth::user()->department_id) {
            abort(403);
        }

        $validated = $request->validate([
            'supervisor_feedback' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $progressReport->update([
            'supervisor_feedback' => $validated['supervisor_feedback'],
            'rating' => $validated['rating'],
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        // Create notification for intern
        $intern->notifications()->create([
            'title' => 'Progress Report Reviewed',
            'message' => "Your {$progressReport->report_type} progress report has been reviewed.",
            'type' => 'general',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('progress-reports.show', $progressReport)
            ->with('success', 'Progress report reviewed successfully.');
    }

    public function destroy(ProgressReport $progressReport)
    {
        // Only interns can delete their own reports
        if (Auth::user()->isApplicant() && $progressReport->intern_id !== Auth::id()) {
            abort(403);
        }

        // Can't delete if already reviewed
        if ($progressReport->reviewed_at) {
            return redirect()->route('progress-reports.show', $progressReport)
                ->with('error', 'Cannot delete report that has been reviewed.');
        }

        $progressReport->delete();

        return redirect()->route('progress-reports.index')
            ->with('success', 'Progress report deleted successfully.');
    }
} 