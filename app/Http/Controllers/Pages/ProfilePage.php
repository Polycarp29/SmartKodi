<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\UserProfile\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

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

        return ProfileInfo::with('user:id, name, email')->where('user_id', $userId)->first();
    }
}
