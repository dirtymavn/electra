<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public static function getPermission()
    {
        $permissions = [
            'User Management' => [
                'register' => [
                    'user.read' => 'Read',
                    'user.create' => 'Create',
                    'user.edit' => 'Edit',
                    'user.destroy' => 'Delete',
                    'user.approval' => 'Approval'
                ],
                'role' => [
                    'role.read' => 'Read',
                    'role.create' => 'Create',
                    'role.edit' => 'Edit',
                    'role.destroy' => 'Delete',
                    'role.approval' => 'Approval'
                ]
            ],
            'Business' => [
                'sales-folder' => [
                    'sales.read' => 'Read',
                    'sales.create' => 'Create',
                    'sales.edit' => 'Edit',
                    'sales.destroy' => 'Delete',
                    'sales.approval' => 'Approval'
                ]
            ],
            'Accounting' => [
                'LG' => [
                    'lg.read' => 'Read',
                    'lg.create' => 'Create',
                    'lg.edit' => 'Edit',
                    'lg.destroy' => 'Delete',
                    'lg.approval' => 'Approval'
                ],
                'Period End' => [
                    'periodend.read' => 'Read',
                    'periodend.create' => 'Create',
                    'periodend.edit' => 'Edit',
                    'periodend.destroy' => 'Delete',
                    'periodend.approval' => 'Approval'
                ],
                'JV Period' => [
                    'jvperiod.read' => 'Read',
                    'jvperiod.create' => 'Create',
                    'jvperiod.edit' => 'Edit',
                    'jvperiod.destroy' => 'Delete',
                    'jvperiod.approval' => 'Approval'
                ]
            ],
            'Master Data' => [
                'customer' => [
                    'customer.read' => 'Read',
                    'customer.create' => 'Create',
                    'customer.edit' => 'Edit',
                    'customer.destroy' => 'Delete',
                    'customer.approval' => 'Approval'
                ],
                'supplier' => [
                    'supplier.read' => 'Read',
                    'supplier.create' => 'Create',
                    'supplier.edit' => 'Edit',
                    'supplier.destroy' => 'Delete',
                    'supplier.approval' => 'Approval'
                ],
                'sales-folder' => [
                    'sales.read' => 'Read',
                    'sales.create' => 'Create',
                    'sales.edit' => 'Edit',
                    'sales.destroy' => 'Delete',
                    'sales.approval' => 'Approval'
                ],
                'guide' => [
                    'guide.read' => 'Read',
                    'guide.create' => 'Create',
                    'guide.edit' => 'Edit',
                    'guide.destroy' => 'Delete',
                    'guide.approval' => 'Approval'
                ],
                'itinerary' => [
                    'itin.read' => 'Read',
                    'itin.create' => 'Create',
                    'itin.edit' => 'Edit',
                    'itin.destroy' => 'Delete',
                    'itin.approval' => 'Approval'
                ],
                'FX Transfer' => [
                    'fx-trans.read' => 'Read',
                    'fx-trans.create' => 'Create',
                    'fx-trans.edit' => 'Edit',
                    'fx-trans.destroy' => 'Delete',
                    'fx-trans.approval' => 'Approval'
                ],
                'Budget' => [
                    'budget-rate.read' => 'Read',
                    'budget-rate.create' => 'Create',
                    'budget-rate.edit' => 'Edit',
                    'budget-rate.destroy' => 'Delete',
                    'budget-rate.approval' => 'Approval'
                ],
                'Account' => [
                    'account.read' => 'Read',
                    'account.create' => 'Create',
                    'account.edit' => 'Edit',
                    'account.destroy' => 'Delete',
                    'account.approval' => 'Approval'
                ],
            ],
            'System' => [
                'company' => [
                    'company.read' => 'Read',
                    'company.create' => 'Create',
                    'company.edit' => 'Edit',
                    'company.destroy' => 'Delete',
                    'company.approval' => 'Approval'
                ]
            ],

        ];

        return $permissions;
    }
}
