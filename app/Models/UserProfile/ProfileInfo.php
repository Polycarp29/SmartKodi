<?php

namespace App\Models\UserProfile;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileInfo extends Model
{
    use SoftDeletes;
    //Profile Info Fillable

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'avatar',
        'id_number',
        'country',
        'c_code',
        'city',
        'address_line_1',
        'address_line_2',
        'user_id',
        'phone',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
