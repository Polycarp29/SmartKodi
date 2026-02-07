<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaintenanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Maintenance/Maintenance', [
            'tickets' => [
                // Mock data for initial UI build
                ['id' => 101, 'title' => 'Leaking Faucet', 'property' => 'Sunset Apartments, Unit 3B', 'priority' => 'Low', 'status' => 'Open', 'date' => '2026-02-06'],
                ['id' => 102, 'title' => 'Broken AC Unit', 'property' => 'Ocean View, Unit 12A', 'priority' => 'High', 'status' => 'In Progress', 'date' => '2026-02-05'],
                ['id' => 103, 'title' => 'Power Outage', 'property' => 'Green Valley, Unit 5C', 'priority' => 'Critical', 'status' => 'Resolved', 'date' => '2026-02-01'],
            ]
        ]);
    }
}
