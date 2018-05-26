<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public static function getPermission()
    {
        $permissions = [
            'Master' => [
                'company' => [
                    'company.create' => 'Create',
                    'company.edit' => 'Edit',
                    'company.destroy' => 'Delete',
                    'company.show' => 'Show',
                    'company.approval' => 'Approval'
                ]
            ],
            'User Management' => [
                'register' => [
                    'user.create' => 'Create',
                    'user.edit' => 'Edit',
                    'user.destroy' => 'Delete',
                    'user.show' => 'Show',
                    'user.approval' => 'Approval'
                ],
                'role' => [
                    'role.create' => 'Create',
                    'role.edit' => 'Edit',
                    'role.destroy' => 'Delete',
                    'role.show' => 'Show',
                    'role.approval' => 'Approval'
                ]
            ],
            'Business' => [
                'customer' => [
                    'customer.create' => 'Create',
                    'customer.edit' => 'Edit',
                    'customer.destroy' => 'Delete',
                    'customer.show' => 'Show',
                    'customer.approval' => 'Approval'
                ],
                'supplier' => [
                    'supplier.create' => 'Create',
                    'supplier.edit' => 'Edit',
                    'supplier.destroy' => 'Delete',
                    'supplier.show' => 'Show',
                    'supplier.approval' => 'Approval'
                ],
                'sales-folder' => [
                    'sales.create' => 'Create',
                    'sales.edit' => 'Edit',
                    'sales.destroy' => 'Delete',
                    'sales.show' => 'Show',
                    'sales.approval' => 'Approval'
                ],
                'transaction' => [
                    'transaction.create' => 'Create',
                    'transaction.edit' => 'Edit',
                    'transaction.destroy' => 'Delete',
                    'transaction.show' => 'Show',
                    'transaction.approval' => 'Approval'
                ],
            ]

        ];

        return $permissions;
    }
}
