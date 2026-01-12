<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Notifications extends Controller
{
    //

    public function viewNotifications(){
        return Inertia::render('Notifications');
    }
}
