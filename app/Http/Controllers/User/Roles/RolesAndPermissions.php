<?php

namespace App\Http\Controllers\User\Roles;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemConfigurations\Authorizations\Roles;

class RolesAndPermissions extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'User is not authenticated');
        }

        $data = $this->fetchAllRoles();
        return Inertia::render('AccountType', [
            'roles' => $data,
        ]);
    }

    public function fetchAllRoles()
    {
        $roles = Roles::where('is_role_active', true)->get();
        return $roles;
    }


    // check the selected role and validate


    public function handleAccountTypeSelection(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'id' => 'required|exists:roles,id',
        ]);

        // Ensure user is authenticated
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'You must be logged in to select an account type.');
        }

        // Attach the role to the user
        $user->roles()->syncWithoutDetaching([$validated['id']]);
        
        // Refresh the user model to ensure middleware sees updated data
        $user->refresh();
        
        // Clear any cached relationship data
        $user->load('roles');

        return redirect()->route('dashboard')
            ->with('success', 'Account type selected and saved successfully.');
    }
}
