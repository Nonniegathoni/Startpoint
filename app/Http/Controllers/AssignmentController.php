<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assignment::with(['department', 'creator']);

        // Filter by department
        if (Auth::user()->isSupervisor()) {
            $query->where('department_id', Auth::user()->department_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $assignments = $query->latest()->paginate(15);

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        // Only supervisors and admins can create assignments
        if (!Auth::user()->isSupervisor() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $departments = Department::where('is_active', true)->get();

        return view('assignments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        // Only supervisors and admins can create assignments
        if (!Auth::user()->isSupervisor() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'due_date' => 'required|date|after:today',
            'priority' => 'required|in:low,medium,high',
        ]);

        $assignment = Assignment::create([
            ...$validated,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Assignment created successfully!');
    }

    public function show(Assignment $assignment)
    {
        // Check permissions
        if (Auth::user()->isSupervisor() && $assignment->department_id !== Auth::user()->department_id) {
            abort(403);
        }

        $assignment->load(['department', 'creator', 'interns', 'evaluations']);

        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        // Only creator or admin can edit
        if ($assignment->created_by !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $departments = Department::where('is_active', true)->get();

        return view('assignments.edit', compact('assignment', 'departments'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        // Only creator or admin can update
        if ($assignment->created_by !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $assignment->update($validated);

        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Assignment updated successfully!');
    }

    public function assignInterns(Request $request, Assignment $assignment)
    {
        // Only supervisors and admins can assign interns
        if (!Auth::user()->isSupervisor() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'intern_ids' => 'required|array',
            'intern_ids.*' => 'exists:users,id',
        ]);

        // Sync interns to assignment
        $assignment->interns()->sync($validated['intern_ids']);

        // Create notifications for assigned interns
        foreach ($validated['intern_ids'] as $internId) {
            $intern = User::find($internId);
            $intern->notifications()->create([
                'title' => 'New Assignment',
                'message' => "You have been assigned to: {$assignment->title}",
                'type' => 'general',
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Interns assigned successfully!');
    }

    public function destroy(Assignment $assignment)
    {
        // Only creator or admin can delete
        if ($assignment->created_by !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
} 