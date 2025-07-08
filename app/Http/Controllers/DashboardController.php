<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opportunity;

class DashboardController extends Controller
{
    public function index()
    {
        // Sample data - replace with your actual logic
        $stats = [
            'opportunities' => Opportunity::count(),
            'departments' => 8, // Replace with actual count
            'cohorts' => 12, // Replace with actual count
            'documents' => 45, // Replace with actual count
        ];

        // Get recent opportunities
        $recentOpportunities = Opportunity::latest()
            ->take(5)
            ->get()
            ->map(function ($opportunity) {
                $opportunity->formatted_amount = $opportunity->compensation_amount > 0 
                    ? 'KES ' . number_format($opportunity->compensation_amount, 0, '.', ',')
                    : $opportunity->compensation_type;
                return $opportunity;
            });

        // Count expiring opportunities (next 7 days)
        $expiringOpportunities = Opportunity::where('expiry_date', '<=', now()->addDays(7))
            ->where('expiry_date', '>=', now())
            ->count();

        return view('dashboard', compact('stats', 'recentOpportunities', 'expiringOpportunities'));
    }
}
