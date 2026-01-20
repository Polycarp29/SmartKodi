<?php

namespace App\Models\SystemConfigurations\Authorizations;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //

    protected $fillabe = [
        'name',
        'uuid',
        'role_description',
        'created_at',
        'updated_at',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'roles_permissions', 'roles_id', 'permissions_id');
    }
}
