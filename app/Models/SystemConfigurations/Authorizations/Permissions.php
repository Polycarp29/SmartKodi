<?php

namespace App\Models\SystemConfigurations\Authorizations;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasUuids;
    //


    protected $fillable = [
        'uuid',
        'permission_name',
        'permission_description',
        'created_at',
        'updated_at',
    ];


    public function uniqueIds()
    {
        return ['uuid'];
    }



    // relationships

    public function rolespermissions()
    {
        return $this->belongsToMany(Roles::class, 'roles_permissions', 'permissions_id', 'roles_id');
    }
}
