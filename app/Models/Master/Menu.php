<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public static function getPermission()
    {
        $permissions = [
            'User Management' => [
                'user.create' => 'Create',
                'user.edit' => 'Edit',
                'user.destroy' => 'Delete',
                'user.show' => 'Show',
                'user.approval' => 'Approval'
            ]
        ];

        return $permissions;
    }
}
