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
                    'Passenger' => [
                        'passenger.read' => 'Read',
                        'passenger.create' => 'Create',
                        'passenger.update' => 'Edit',
                        'passenger.destroy' => 'Delete',
                        'passenger.approval' => 'Approval',
                    ],
                    'Airline' => [
                        'airline.read' => 'Read',
                        'airline.create' => 'Create',
                        'airline.update' => 'Edit',
                        'airline.destroy' => 'Delete',
                        'airline.approval' => 'Approval',
                    ],
                    'Product Type' => [
                        'product-type.read' => 'Read',
                        'product-type.create' => 'Create',
                        'product-type.update' => 'Edit',
                        'product-type.destroy' => 'Delete',
                        'product-type.approval' => 'Approval',
                    ],
                    'Region' => [
                        'region.read' => 'Read',
                        'region.create' => 'Create',
                        'region.update' => 'Edit',
                        'region.destroy' => 'Delete',
                        'region.approval' => 'Approval',
                    ],
                    'GST' => [
                        'gst.read' => 'Read',
                        'gst.create' => 'Create',
                        'gst.update' => 'Edit',
                        'gst.destroy' => 'Delete',
                        'gst.approval' => 'Approval',
                    ],
                    'Currency Rate' => [
                        'currencyrate.read' => 'Read',
                        'currencyrate.create' => 'Create',
                        'currencyrate.update' => 'Edit',
                        'currencyrate.destroy' => 'Delete',
                        'currencyrate.approval' => 'Approval',
                    ],
                    'Country' => [
                        'country.read' => 'Read',
                        'country.create' => 'Create',
                        'country.update' => 'Edit',
                        'country.destroy' => 'Delete',
                        'country.approval' => 'Approval',
                    ],
                    'City' => [
                        'city.read' => 'Read',
                        'city.create' => 'Create',
                        'city.update' => 'Edit',
                        'city.destroy' => 'Delete',
                        'city.approval' => 'Approval',
                    ],
                    'Airport' => [
                        'airport.read' => 'Read',
                        'airport.create' => 'Create',
                        'airport.update' => 'Edit',
                        'airport.destroy' => 'Delete',
                        'airport.approval' => 'Approval',
                    ],
                    'Tour' => [
                        'tour.read' => 'Read',
                        'tour.create' => 'Create',
                        'tour.update' => 'Edit',
                        'tour.destroy' => 'Delete',
                        'tour.approval' => 'Approval',
                    ],
                    'Product Code' => [
                        'productcode.read' => 'Read',
                        'productcode.create' => 'Create',
                        'productcode.update' => 'Edit',
                        'productcode.destroy' => 'Delete',
                        'productcode.approval' => 'Approval',
                    ],
                    'Branch' => [
                        'branch.read' => 'Read',
                        'branch.create' => 'Create',
                        'branch.update' => 'Edit',
                        'branch.destroy' => 'Delete',
                        'branch.approval' => 'Approval',
                    ],
                    'Department' => [
                        'department.read' => 'Read',
                        'department.create' => 'Create',
                        'department.update' => 'Edit',
                        'department.destroy' => 'Delete',
                        'department.approval' => 'Approval',
                    ],
                ],
                'Outbound' => [
                    'Tour Order' => [
                        'tourorder.read' => 'Read',
                        'tourorder.create' => 'Create',
                        'tourorder.update' => 'Edit',
                        'tourorder.destroy' => 'Delete',
                        'tourorder.approval' => 'Approval',
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
                    'Core Status' => [
                        'core-status.read' => 'Read',
                        'core-status.create' => 'Create',
                        'core-status.update' => 'Edit',
                        'core-status.destroy' => 'Delete',
                        'core-status.approval' => 'Approval',
                    ],
                    'Core Config' => [
                        'core-config.read' => 'Read',
                        'core-config.create' => 'Create',
                        'core-config.update' => 'Edit',
                        'core-config.destroy' => 'Delete',
                        'core-config.approval' => 'Approval',
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
                    'Passenger' => [
                        'passenger.read' => 'Read',
                        'passenger.create' => 'Create',
                        'passenger.update' => 'Edit',
                        'passenger.destroy' => 'Delete',
                        'passenger.approval' => 'Approval',
                    ],
                    'Airline' => [
                        'airline.read' => 'Read',
                        'airline.create' => 'Create',
                        'airline.update' => 'Edit',
                        'airline.destroy' => 'Delete',
                        'airline.approval' => 'Approval',
                    ],
                    'Product Type' => [
                        'product-type.read' => 'Read',
                        'product-type.create' => 'Create',
                        'product-type.update' => 'Edit',
                        'product-type.destroy' => 'Delete',
                        'product-type.approval' => 'Approval',
                    ],
                    'Region' => [
                        'region.read' => 'Read',
                        'region.create' => 'Create',
                        'region.update' => 'Edit',
                        'region.destroy' => 'Delete',
                        'region.approval' => 'Approval',
                    ],
                    'GST' => [
                        'gst.read' => 'Read',
                        'gst.create' => 'Create',
                        'gst.update' => 'Edit',
                        'gst.destroy' => 'Delete',
                        'gst.approval' => 'Approval',
                    ],
                    'Currency Rate' => [
                        'currencyrate.read' => 'Read',
                        'currencyrate.create' => 'Create',
                        'currencyrate.update' => 'Edit',
                        'currencyrate.destroy' => 'Delete',
                        'currencyrate.approval' => 'Approval',
                    ],
                    'Country' => [
                        'country.read' => 'Read',
                        'country.create' => 'Create',
                        'country.update' => 'Edit',
                        'country.destroy' => 'Delete',
                        'country.approval' => 'Approval',
                    ],
                    'City' => [
                        'city.read' => 'Read',
                        'city.create' => 'Create',
                        'city.update' => 'Edit',
                        'city.destroy' => 'Delete',
                        'city.approval' => 'Approval',
                    ],
                    'Airport' => [
                        'airport.read' => 'Read',
                        'airport.create' => 'Create',
                        'airport.update' => 'Edit',
                        'airport.destroy' => 'Delete',
                        'airport.approval' => 'Approval',
                    ],
                    'Tour' => [
                        'tour.read' => 'Read',
                        'tour.create' => 'Create',
                        'tour.update' => 'Edit',
                        'tour.destroy' => 'Delete',
                        'tour.approval' => 'Approval',
                    ],
                    'Product Code' => [
                        'productcode.read' => 'Read',
                        'productcode.create' => 'Create',
                        'productcode.update' => 'Edit',
                        'productcode.destroy' => 'Delete',
                        'productcode.approval' => 'Approval',
                    ],
                    'Branch' => [
                        'branch.read' => 'Read',
                        'branch.create' => 'Create',
                        'branch.update' => 'Edit',
                        'branch.destroy' => 'Delete',
                        'branch.approval' => 'Approval',
                    ],
                    'Department' => [
                        'department.read' => 'Read',
                        'department.create' => 'Create',
                        'department.update' => 'Edit',
                        'department.destroy' => 'Delete',
                        'department.approval' => 'Approval',
                    ],
                ],
                'Outbound' => [
                    'Tour Order' => [
                        'tourorder.read' => 'Read',
                        'tourorder.create' => 'Create',
                        'tourorder.update' => 'Edit',
                        'tourorder.destroy' => 'Delete',
                        'tourorder.approval' => 'Approval',
                    ],
                ],
                'System' => [
                    'Core Status' => [
                        'core-status.read' => 'Read',
                        'core-status.create' => 'Create',
                        'core-status.update' => 'Edit',
                        'core-status.destroy' => 'Delete',
                        'core-status.approval' => 'Approval',
                    ],
                    'Core Config' => [
                        'core-config.read' => 'Read',
                        'core-config.create' => 'Create',
                        'core-config.update' => 'Edit',
                        'core-config.destroy' => 'Delete',
                        'core-config.approval' => 'Approval',
                    ],
                ]

            ];

        }

        return $permissions;
    }
}
