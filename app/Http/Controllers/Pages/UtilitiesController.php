<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UtilitiesController extends Controller
{
    public function water()
    {
        return Inertia::render('Utilities/Water');
    }

    public function electricity()
    {
        return Inertia::render('Utilities/Electricity');
    }

    public function gas()
    {
        return Inertia::render('Utilities/Gas');
    }
}
