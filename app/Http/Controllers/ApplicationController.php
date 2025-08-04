<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Opportunity;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['applicant', 'opportunity', 'reviewer']);

        // Filter by user type
        if (Auth::user()->isApplicant()) {
            $query->where('applicant_id', Auth::id());
        } elseif (Auth::user()->isAdmin() || Auth::user()->isHrOfficer()) {
            // Admins and HR can see all applications
        } else {
            // Supervisors can see applications for their department
            $query->whereHas('opportunity.department', function ($q) {
                $q->where('id', Auth::user()->department_id);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by opportunity
        if ($request->filled('opportunity_id')) {
            $query->where('opportunity_id', $request->opportunity_id);
        }

        $applications = $query->latest()->paginate(15);

        return view('applications.index', compact('applications'));
    }

    public function create(Opportunity $opportunity)
    {
        // Check if user already applied
        $existingApplication = Application::where('applicant_id', Auth::id())
            ->where('opportunity_id', $opportunity->id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('applications.show', $existingApplication)
                ->with('info', 'You have already applied for this opportunity.');
        }

        return view('applications.create', compact('opportunity'));
    }

    public function store(Request $request, Opportunity $opportunity)
    {
        $validated = $request->validate([
            'cover_letter' => 'required|string|max:2000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'additional_notes' => 'nullable|string|max:1000',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Create application
        $application = Application::create([
            'applicant_id' => Auth::id(),
            'opportunity_id' => $opportunity->id,
            'cover_letter' => $validated['cover_letter'],
            'additional_notes' => $validated['additional_notes'],
            'submitted_at' => now(),
            'created_by' => Auth::id(),
        ]);

        // Store resume
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->update(['resume_path' => $resumePath]);
        }

        // Store additional documents
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('documents', 'public');
                Document::create([
                    'application_id' => $application->id,
                    'document_type' => 'other',
                    'file_name' => $document->getClientOriginalName(),
                    'file_path' => $path,
                    'file_size' => $document->getSize(),
                    'mime_type' => $document->getMimeType(),
                    'created_by' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('applications.show', $application)
            ->with('success', 'Application submitted successfully!');
    }

    public function show(Application $application)
    {
        // Check permissions
        if (Auth::user()->isApplicant() && $application->applicant_id !== Auth::id()) {
            abort(403);
        }

        $application->load(['applicant', 'opportunity', 'reviewer', 'documents']);

        return view('applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        // Only applicants can edit their own applications
        if (Auth::user()->isApplicant() && $application->applicant_id !== Auth::id()) {
            abort(403);
        }

        // Can't edit if already reviewed
        if (in_array($application->status, ['approved', 'rejected'])) {
            return redirect()->route('applications.show', $application)
                ->with('error', 'Cannot edit application that has been reviewed.');
        }

        $application->load(['opportunity', 'documents']);

        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        // Only applicants can update their own applications
        if (Auth::user()->isApplicant() && $application->applicant_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'cover_letter' => 'required|string|max:2000',
            'additional_notes' => 'nullable|string|max:1000',
            'new_documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $application->update([
            'cover_letter' => $validated['cover_letter'],
            'additional_notes' => $validated['additional_notes'],
        ]);

        // Store new documents
        if ($request->hasFile('new_documents')) {
            foreach ($request->file('new_documents') as $document) {
                $path = $document->store('documents', 'public');
                Document::create([
                    'application_id' => $application->id,
                    'document_type' => 'other',
                    'file_name' => $document->getClientOriginalName(),
                    'file_path' => $path,
                    'file_size' => $document->getSize(),
                    'mime_type' => $document->getMimeType(),
                    'created_by' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('applications.show', $application)
            ->with('success', 'Application updated successfully!');
    }

    public function withdraw(Application $application)
    {
        // Only applicants can withdraw their own applications
        if (Auth::user()->isApplicant() && $application->applicant_id !== Auth::id()) {
            abort(403);
        }

        $application->update([
            'status' => 'withdrawn',
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->route('applications.index')
            ->with('success', 'Application withdrawn successfully.');
    }

    public function review(Request $request, Application $application)
    {
        // Only admins and HR can review applications
        if (!Auth::user()->isAdmin() && !Auth::user()->isHrOfficer()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:shortlisted,approved,rejected',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $validated['status'],
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        // Create notification for applicant
        $application->applicant->notifications()->create([
            'title' => 'Application Update',
            'message' => "Your application for {$application->opportunity->title} has been {$validated['status']}.",
            'type' => 'application_update',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('applications.show', $application)
            ->with('success', 'Application reviewed successfully.');
    }
} 