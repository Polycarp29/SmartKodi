<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AIRecommendations extends Controller
{
    //

    public function index(){
        return Inertia::render('AIRecommendations');
    }
}
