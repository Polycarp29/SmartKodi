<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinancialsController extends Controller
{
    public function rentPayments()
    {
        return Inertia::render('Financials/RentPayments');
    }

    public function expenses()
    {
        return Inertia::render('Financials/Expenses');
    }

    public function invoices()
    {
        return Inertia::render('Financials/Invoices');
    }
}
