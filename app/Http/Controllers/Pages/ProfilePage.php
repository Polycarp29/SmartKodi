<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProfilePage extends Controller
{
    //

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        Log::info('Profile Data', [
            'data' => $this->fetchUserProfiles(),
        ]);

        return Inertia::render('Profile', [
            'data' => $this->fetchUserProfiles(),
        ]);
    }

    protected function fetchUserProfiles()
    {
        $userId = Auth::id();

        if (!$userId) {
            Log::warning('Unauthenticated user tried to access profile data.');
            return collect(); // empty collection
        }

        return User::with('profileInfo')->where('id', $userId)->first();
    }
}
