<?php

namespace App\Http\Controllers\User\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesAndPermissions extends Controller
{
    //

    public function fetchAllRoles(){
        $roles = Roles::where()->get();
    }
}
