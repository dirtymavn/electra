<?php

use Illuminate\Database\Seeder;
use App\Models\Setting\CoreForm;

class CoreFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('core_forms')->truncate();

        CoreForm::insert([
        	[
        		'name' => 'Register User',
		    	'slug' => 'register-user',
		        'label' => 'Register User',
		        'code' => 'REG',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Role User',
		    	'slug' => 'role-user',
		        'label' => 'Role User',
		        'code' => 'ROL',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Sales',
		    	'slug' => 'sales',
		        'label' => 'Sales',
		        'code' => 'SLS',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Invoice',
		    	'slug' => 'invoice',
		        'label' => 'Invoice',
		        'code' => 'INV',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Delivery',
		    	'slug' => 'delivery',
		        'label' => 'Delivery',
		        'code' => 'DEL',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Visa',
		    	'slug' => 'visa',
		        'label' => 'Visa',
		        'code' => 'VIS',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Queue',
		    	'slug' => 'queue',
		        'label' => 'Queue',
		        'code' => 'QUE',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Tour Folder',
		    	'slug' => 'tour-folder',
		        'label' => 'Tour Folder',
		        'code' => 'TFD',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Tour Order',
		    	'slug' => 'tour-order',
		        'label' => 'Tour Order',
		        'code' => 'TOD',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Availability',
		    	'slug' => 'availability',
		        'label' => 'Availability',
		        'code' => 'AVL',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Enquiry',
		    	'slug' => 'enquiry',
		        'label' => 'Enquiry',
		        'code' => 'ENQ',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Booking',
		    	'slug' => 'booking',
		        'label' => 'Booking',
		        'code' => 'BOO',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'FIT Folder',
		    	'slug' => 'fit-folder',
		        'label' => 'FIT Folder',
		        'code' => 'FTF',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'FIT Order',
		    	'slug' => 'fit-order',
		        'label' => 'FIT Order',
		        'code' => 'FTO',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Misc Invoice',
		    	'slug' => 'misc-invoice',
		        'label' => 'Misc Invoice',
		        'code' => 'MIS',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Credit Note',
		    	'slug' => 'credit-note',
		        'label' => 'Credit Note',
		        'code' => 'CNOTE',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Billing',
		    	'slug' => 'billing',
		        'label' => 'Billing',
		        'code' => 'BILL',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'LG',
		    	'slug' => 'lg',
		        'label' => 'LG',
		        'code' => 'LG',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'LG Delivery',
		    	'slug' => 'lg-delivery',
		        'label' => 'LG Delivery',
		        'code' => 'LGDL',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Pay Request',
		    	'slug' => 'pay-request',
		        'label' => 'Pay Request',
		        'code' => 'PRQ',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Petty Cash',
		    	'slug' => 'petty-cash',
		        'label' => 'Petty Cash',
		        'code' => 'PET',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Deposit',
		    	'slug' => 'deposit',
		        'label' => 'Deposit',
		        'code' => 'DEP',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Settlement',
		    	'slug' => 'ettlement',
		        'label' => 'Settlement',
		        'code' => 'SET',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Receipt',
		    	'slug' => 'receipt',
		        'label' => 'Receipt',
		        'code' => 'RC',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Receipt Voucher',
		    	'slug' => 'receipt-voucher',
		        'label' => 'Receipt Voucher',
		        'code' => 'RCVO',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Payment',
		    	'slug' => 'payment',
		        'label' => 'Payment',
		        'code' => 'PAY',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Journal',
		    	'slug' => 'journal',
		        'label' => 'Journal',
		        'code' => 'JOU',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Posting',
		    	'slug' => 'posting',
		        'label' => 'Posting',
		        'code' => 'POST',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Period End',
		    	'slug' => 'period-end',
		        'label' => 'Period End',
		        'code' => 'PER',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'JV Period',
		    	'slug' => 'jv-period',
		        'label' => 'JV Period',
		        'code' => 'JVP',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Journal',
		    	'slug' => 'journal',
		        'label' => 'Journal',
		        'code' => 'JOU',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Reconciliation',
		    	'slug' => 'reconciliation',
		        'label' => 'Reconciliation',
		        'code' => 'RC',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Bank Reconciliation',
		    	'slug' => 'bank-reconciliation',
		        'label' => 'Bank Reconciliation',
		        'code' => 'BKRC',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'BSP Reconciliation',
		    	'slug' => 'bsp-reconciliation',
		        'label' => 'BSP Reconciliation',
		        'code' => 'BSRC',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Refund',
		    	'slug' => 'refund',
		        'label' => 'Refund',
		        'code' => 'RFN',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Budget',
		    	'slug' => 'budget',
		        'label' => 'Budget',
		        'code' => 'BUD',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Financial Analysis',
		    	'slug' => 'financial-analysis',
		        'label' => 'Financial Analysis',
		        'code' => 'FIN',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Cheque Printing',
		    	'slug' => 'cheque-printing',
		        'label' => 'Cheque Printing',
		        'code' => 'CHQ',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Bank Deposit',
		    	'slug' => 'bank-deposit',
		        'label' => 'Bank Deposit',
		        'code' => 'BDEP',
		        'type' => 'Trx'
        	],
        	[
        		'name' => 'Customer',
		    	'slug' => 'customer',
		        'label' => 'Customer',
		        'code' => 'CUST',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Hotel',
		    	'slug' => 'hotel',
		        'label' => 'Hotel',
		        'code' => 'HTL',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Supplier',
		    	'slug' => 'supplier',
		        'label' => 'Supplier',
		        'code' => 'SUP',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Inventory',
		    	'slug' => 'inventory',
		        'label' => 'Inventory',
		        'code' => 'INVY',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Voucher',
		    	'slug' => 'voucher',
		        'label' => 'Voucher',
		        'code' => 'VO',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Guide',
		    	'slug' => 'guide',
		        'label' => 'Guide',
		        'code' => 'GUIDE',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Itinerary',
		    	'slug' => 'itinerary',
		        'label' => 'Itinerary',
		        'code' => 'ITIN',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Air Allotment',
		    	'slug' => 'air-allotment',
		        'label' => 'Air Allotment',
		        'code' => 'ALLOT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'FX Transfer',
		    	'slug' => 'fx-transfer',
		        'label' => 'FX Transfer',
		        'code' => 'FXT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Budget Rate',
		    	'slug' => 'budget-rate',
		        'label' => 'Budget Rate',
		        'code' => 'BUD',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Account',
		    	'slug' => 'account',
		        'label' => 'Account',
		        'code' => 'ACC',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Credit Card',
		    	'slug' => 'credit-card',
		        'label' => 'Credit Card',
		        'code' => 'CC',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Passenger',
		    	'slug' => 'passenger',
		        'label' => 'Passenger',
		        'code' => 'PASS',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Airline',
		    	'slug' => 'airline',
		        'label' => 'Airline',
		        'code' => 'AIR',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Product Code',
		    	'slug' => 'product-code',
		        'label' => 'Product Code',
		        'code' => 'PC',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Product Type',
		    	'slug' => 'product-type',
		        'label' => 'Product Type',
		        'code' => 'PT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Product Category',
		    	'slug' => 'product-category',
		        'label' => 'Product Category',
		        'code' => 'PCAT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Region',
		    	'slug' => 'region',
		        'label' => 'Region',
		        'code' => 'REG',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'GST',
		    	'slug' => 'gst',
		        'label' => 'GST',
		        'code' => 'GST',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Currecy Rate',
		    	'slug' => 'currecy-rate',
		        'label' => 'Currecy Rate',
		        'code' => 'CUR',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Country',
		    	'slug' => 'country',
		        'label' => 'Country',
		        'code' => 'CON',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'City',
		    	'slug' => 'city',
		        'label' => 'City',
		        'code' => 'CTY',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Airport',
		    	'slug' => 'airport',
		        'label' => 'Airport',
		        'code' => 'AIRP',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Tour',
		    	'slug' => 'tour',
		        'label' => 'Tour',
		        'code' => 'TOUR',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'DO Type',
		    	'slug' => 'do-type',
		        'label' => 'DO Type',
		        'code' => 'DOT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Master Document',
		    	'slug' => 'master-document',
		        'label' => 'Master Document',
		        'code' => 'MDOC',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Branch',
		    	'slug' => 'branch',
		        'label' => 'Branch',
		        'code' => 'BRNC',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Department',
		    	'slug' => 'department',
		        'label' => 'Department',
		        'code' => 'DEPT',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Inventory Type',
		    	'slug' => 'inventory-type',
		        'label' => 'Inventory Type',
		        'code' => 'INVTYPE',
		        'type' => 'Master'
        	],
        	[
        		'name' => 'Logs',
		    	'slug' => 'logs',
		        'label' => 'Logs',
		        'code' => 'LOG',
		        'type' => 'Core'
        	],
        	[
        		'name' => 'Company',
		    	'slug' => 'company',
		        'label' => 'Company',
		        'code' => 'COM',
		        'type' => 'Core'
        	],
        ]);
    }
}
