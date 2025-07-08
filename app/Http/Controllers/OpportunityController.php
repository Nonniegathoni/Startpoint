<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opportunity;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Opportunity::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('opportunity_description', 'like', '%' . $request->search . '%');
        }

        // Department filter
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        $opportunities = $query->paginate(10);

        // Add status to each opportunity
        $opportunities->getCollection()->transform(function ($opportunity) {
            $opportunity->status = $this->getOpportunityStatus($opportunity);
            return $opportunity;
        });

        // Get stats
        $stats = [
            'total' => Opportunity::count(),
            'active' => Opportunity::where('expiry_date', '>', now())->count(),
            'expiring' => Opportunity::where('expiry_date', '<=', now()->addDays(7))
                                   ->where('expiry_date', '>', now())->count(),
            'expired' => Opportunity::where('expiry_date', '<', now())->count(),
        ];

        // Get unique departments for filter
        $departments = Opportunity::distinct()->pluck('department')->filter();

        return view('opportunities.index', compact('opportunities', 'stats', 'departments'));
    }

    public function create()
    {
        $departments = [
            'IT' => 'Information Technology',
            'HR' => 'Human Resources',
            'Finance' => 'Finance',
            'Marketing' => 'Marketing',
            'Operations' => 'Operations',
            'Sales' => 'Sales',
            'Engineering' => 'Engineering',
            'Design' => 'Design'
        ];

        $opportunityTypes = [
            'Internship' => 'Internship',
            'Full-time' => 'Full-time',
            'Part-time' => 'Part-time',
            'Contract' => 'Contract',
            'Volunteer' => 'Volunteer',
            'Research' => 'Research'
        ];

        $compensationTypes = [
            'Paid' => 'Paid',
            'Unpaid' => 'Unpaid',
            'Stipend' => 'Stipend',
            'Commission' => 'Commission-based'
        ];

        return view('opportunities.create', compact('departments', 'opportunityTypes', 'compensationTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string',
            'opportunity_type' => 'required|string',
            'compensation_type' => 'required|string',
            'compensation_amount' => 'nullable|numeric|min:0',
            'compensation_currency' => 'required|string|default:KES',
            'expiry_date' => 'required|date|after:today',
            'opportunity_description' => 'required|string',
            'core_competencies' => 'nullable|string',
        ]);

        Opportunity::create($validated);

        return redirect()->route('opportunities.index')
                        ->with('success', 'Opportunity created successfully!');
    }

    public function show(Opportunity $opportunity)
    {
        $opportunity->status = $this->getOpportunityStatus($opportunity);
        return view('opportunities.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        // Same options as create
        $departments = [
            'IT' => 'Information Technology',
            'HR' => 'Human Resources',
            'Finance' => 'Finance',
            'Marketing' => 'Marketing',
            'Operations' => 'Operations',
            'Sales' => 'Sales',
            'Engineering' => 'Engineering',
            'Design' => 'Design'
        ];

        $opportunityTypes = [
            'Internship' => 'Internship',
            'Full-time' => 'Full-time',
            'Part-time' => 'Part-time',
            'Contract' => 'Contract',
            'Volunteer' => 'Volunteer',
            'Research' => 'Research'
        ];

        $compensationTypes = [
            'Paid' => 'Paid',
            'Unpaid' => 'Unpaid',
            'Stipend' => 'Stipend',
            'Commission' => 'Commission-based'
        ];

        return view('opportunities.edit', compact('opportunity', 'departments', 'opportunityTypes', 'compensationTypes'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string',
            'opportunity_type' => 'required|string',
            'compensation_type' => 'required|string',
            'compensation_amount' => 'nullable|numeric|min:0',
            'compensation_currency' => 'required|string|default:KES',
            'expiry_date' => 'required|date',
            'opportunity_description' => 'required|string',
            'core_competencies' => 'nullable|string',
        ]);

        $opportunity->update($validated);

        return redirect()->route('opportunities.index')
                        ->with('success', 'Opportunity updated successfully!');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();

        return redirect()->route('opportunities.index')
                        ->with('success', 'Opportunity deleted successfully!');
    }

    private function getOpportunityStatus($opportunity)
    {
        $now = now();
        $expiryDate = \Carbon\Carbon::parse($opportunity->expiry_date);

        if ($expiryDate->isPast()) {
            return 'Expired';
        } elseif ($expiryDate->diffInDays($now) <= 7) {
            return 'Expiring Soon';
        } else {
            return 'Active';
        }
    }
}
