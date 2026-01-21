<?php

namespace App\Models\SystemConfigurations\Authorizations;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

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
}
