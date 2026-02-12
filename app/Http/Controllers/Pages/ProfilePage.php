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

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $profileInfo = $user->profileInfo ?? new ProfileInfo(['user_id' => $user->id]);

        // Remove avatar from validated data to handle it separately
        $data = $validated;
        unset($data['avatar']);

        $profileInfo->fill($data);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profileInfo->avatar = $path;
        }

        $profileInfo->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
