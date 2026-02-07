<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    //

    public function index(){
        return Inertia::render('Settings');
    }

    public function subscriptions() {
        return Inertia::render('Settings/Subscriptions');
    }

    public function aiSettings() {
        return Inertia::render('Settings/AISettings');
    }

    public function smsSettings() {
        return Inertia::render('Settings/SMSSettings');
    }

    public function rolesPermissions() {
        return Inertia::render('Settings/RolesPermissions');
    }

    public function security2fa() {
        return Inertia::render('Settings/Security2FA');
    }

    public function propertySettings() {
        return Inertia::render('Settings/PropertySettings');
    }
}
