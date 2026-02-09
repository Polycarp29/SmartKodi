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

    public function index(){
        $user = Auth::user();
        if(!$user){
            return redirect()->route('auth.login')->with('error', 'User is not authenticated');
        }

        $data = $this->fetchAllRoles();
        return Inertia::render('AccountType', [
            'roles' => $data,
        ]);
    }

    public function fetchAllRoles(){
        $roles = Roles::where('is_role_active', true)->get();
        return $roles;
    }


}
