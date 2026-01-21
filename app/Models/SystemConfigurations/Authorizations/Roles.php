<?php

namespace App\Models\SystemConfigurations\Authorizations;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Roles extends Model
{

    use HasUuids;
    //

    protected $fillabe = [
        'name',
        'uuid',
        'role_description',
        'created_at',
        'updated_at',
    ];


    public function uniqueIds(){
        return ['uuid'];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'roles_permissions', 'roles_id', 'permissions_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_roles', 'roles_id', 'user_id');
    }
}
