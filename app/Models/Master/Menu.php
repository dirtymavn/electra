<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public static function getPermission()
    {
        if (user_info()->inRole('super-admin')) {
            $permissions = [
                'User Management' => [
                    'register' => [
                        'user.read' => 'Read',
                        'user.create' => 'Create',
                        'user.update' => 'Edit',
                        'user.destroy' => 'Delete',
                        'user.approval' => 'Approval',
                    ],
                    'role' => [
                        'role.read' => 'Read',
                        'role.create' => 'Create',
                        'role.update' => 'Edit',
                        'role.destroy' => 'Delete',
                        'role.approval' => 'Approval',
                    ],
                ],
                'Accounting' => [
                    'LG' => [
                        'lg.read' => 'Read',
                        'lg.create' => 'Create',
                        'lg.update' => 'Edit',
                        'lg.destroy' => 'Delete',
                        'lg.approval' => 'Approval',
                    ],
                    'Period End' => [
                        'periodend.read' => 'Read',
                        'periodend.create' => 'Create',
                        'periodend.update' => 'Edit',
                        'periodend.destroy' => 'Delete',
                        'periodend.approval' => 'Approval',
                    ],
                    'JV Period' => [
                        'jvperiod.read' => 'Read',
                        'jvperiod.create' => 'Create',
                        'jvperiod.update' => 'Edit',
                        'jvperiod.destroy' => 'Delete',
                        'jvperiod.approval' => 'Approval',
                    ],
                ],
                'Master Data' => [
                    'Customer' => [
                        'customer.read' => 'Read',
                        'customer.create' => 'Create',
                        'customer.update' => 'Edit',
                        'customer.destroy' => 'Delete',
                        'customer.approval' => 'Approval',
                    ],
                    'Supplier' => [
                        'supplier.read' => 'Read',
                        'supplier.create' => 'Create',
                        'supplier.update' => 'Edit',
                        'supplier.destroy' => 'Delete',
                        'supplier.approval' => 'Approval',
                    ],
                    'Inventory' => [
                        'inventory.read' => 'Read',
                        'inventory.create' => 'Create',
                        'inventory.update' => 'Edit',
                        'inventory.destroy' => 'Delete',
                        'inventory.approval' => 'Approval',
                    ],
                    'Voucher' => [
                        'voucher.read' => 'Read',
                        'voucher.create' => 'Create',
                        'voucher.update' => 'Edit',
                        'voucher.destroy' => 'Delete',
                        'voucher.approval' => 'Approval',
                    ],
                    'Guide' => [
                        'guide.read' => 'Read',
                        'guide.create' => 'Create',
                        'guide.update' => 'Edit',
                        'guide.destroy' => 'Delete',
                        'guide.approval' => 'Approval',
                    ],
                    'Itinerary' => [
                        'itin.read' => 'Read',
                        'itin.create' => 'Create',
                        'itin.update' => 'Edit',
                        'itin.destroy' => 'Delete',
                        'itin.approval' => 'Approval',
                    ],
                    'FX Transfer' => [
                        'fx-trans.read' => 'Read',
                        'fx-trans.create' => 'Create',
                        'fx-trans.update' => 'Edit',
                        'fx-trans.destroy' => 'Delete',
                        'fx-trans.approval' => 'Approval',
                    ],
                    'Budget Rate' => [
                        'budget-rate.read' => 'Read',
                        'budget-rate.create' => 'Create',
                        'budget-rate.update' => 'Edit',
                        'budget-rate.destroy' => 'Delete',
                        'budget-rate.approval' => 'Approval',
                    ],
                    'Account' => [
                        'account.read' => 'Read',
                        'account.create' => 'Create',
                        'account.update' => 'Edit',
                        'account.destroy' => 'Delete',
                        'account.approval' => 'Approval',
                    ],
                ],
                'System' => [
                    'Company' => [
                        'company.read' => 'Read',
                        'company.create' => 'Create',
                        'company.update' => 'Edit',
                        'company.destroy' => 'Delete',
                        'company.approval' => 'Approval',
                    ],
                ],

            ];

        } elseif (user_info()->inRole('admin')) {
            $permissions = [
                'Accounting' => [
                    'LG' => [
                        'lg.read' => 'Read',
                        'lg.create' => 'Create',
                        'lg.update' => 'Edit',
                        'lg.destroy' => 'Delete',
                        'lg.approval' => 'Approval',
                    ],
                    'Period End' => [
                        'periodend.read' => 'Read',
                        'periodend.create' => 'Create',
                        'periodend.update' => 'Edit',
                        'periodend.destroy' => 'Delete',
                        'periodend.approval' => 'Approval',
                    ],
                    'JV Period' => [
                        'jvperiod.read' => 'Read',
                        'jvperiod.create' => 'Create',
                        'jvperiod.update' => 'Edit',
                        'jvperiod.destroy' => 'Delete',
                        'jvperiod.approval' => 'Approval',
                    ],
                ],
                'Master Data' => [
                    'Customer' => [
                        'customer.read' => 'Read',
                        'customer.create' => 'Create',
                        'customer.update' => 'Edit',
                        'customer.destroy' => 'Delete',
                        'customer.approval' => 'Approval',
                    ],
                    'Supplier' => [
                        'supplier.read' => 'Read',
                        'supplier.create' => 'Create',
                        'supplier.update' => 'Edit',
                        'supplier.destroy' => 'Delete',
                        'supplier.approval' => 'Approval',
                    ],
                    'Inventory' => [
                        'inventory.read' => 'Read',
                        'inventory.create' => 'Create',
                        'inventory.update' => 'Edit',
                        'inventory.destroy' => 'Delete',
                        'inventory.approval' => 'Approval',
                    ],
                    'Voucher' => [
                        'voucher.read' => 'Read',
                        'voucher.create' => 'Create',
                        'voucher.update' => 'Edit',
                        'voucher.destroy' => 'Delete',
                        'voucher.approval' => 'Approval',
                    ],
                    'Guide' => [
                        'guide.read' => 'Read',
                        'guide.create' => 'Create',
                        'guide.update' => 'Edit',
                        'guide.destroy' => 'Delete',
                        'guide.approval' => 'Approval',
                    ],
                    'Itinerary' => [
                        'itin.read' => 'Read',
                        'itin.create' => 'Create',
                        'itin.update' => 'Edit',
                        'itin.destroy' => 'Delete',
                        'itin.approval' => 'Approval',
                    ],
                    'FX Transfer' => [
                        'fx-trans.read' => 'Read',
                        'fx-trans.create' => 'Create',
                        'fx-trans.update' => 'Edit',
                        'fx-trans.destroy' => 'Delete',
                        'fx-trans.approval' => 'Approval',
                    ],
                    'Budget Rate' => [
                        'budget-rate.read' => 'Read',
                        'budget-rate.create' => 'Create',
                        'budget-rate.update' => 'Edit',
                        'budget-rate.destroy' => 'Delete',
                        'budget-rate.approval' => 'Approval',
                    ],
                    'Account' => [
                        'account.read' => 'Read',
                        'account.create' => 'Create',
                        'account.update' => 'Edit',
                        'account.destroy' => 'Delete',
                        'account.approval' => 'Approval',
                    ],
                ]

            ];

        }

        return $permissions;
    }
}
