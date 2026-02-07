<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render('Reports/Reports', [
            'stats' => [
                // Mock stats for dashboard
                'total_revenue' => 4500000,
                'occupancy_rate' => 95,
                'pending_maintenance' => 12,
                'outstanding_payments' => 350000
            ]
        ]);
    }
}
