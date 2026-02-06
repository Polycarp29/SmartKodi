<?php

namespace App\Services\System;

use App\Models\User;
use Illuminate\Support\Facades\Log;


class CheckUserAccessLevel
{


    //check user validity

    public function checkAccessLevel($user)
    {
        if (!$user) {
            Log::error('User check failed', [
                'message' => 'User not available'
            ]);
            return response()->json([
                'message' => 'User is not available',
            ], 404);
        }

        $userId = $user->id;

        $checkedUser = User::find($userId);

        if (!$checkedUser) {
            Log::error('Error', [
                'message' => 'User not Found'
            ]);
            return response()->json([
                'status' => false,
                'message' => 'User not foud',
            ]);
        }

        if (!empty($checkedUser->parent_id)) {
            return response()->json([
                'status' => true,
                'message' => 'User is associated with a parent',
                'type' => 'child user',
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'The user is a parent',
            'type' => 'parent',
        ]);
    }
}
