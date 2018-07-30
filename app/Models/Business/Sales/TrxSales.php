<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

use Request;
use App\Models\MasterData\Customer\MasterCustomer;

class TrxSales extends Model
{
    protected $table = 'trx_sales';

    protected $fillable = [
        'sales_no',
        'customer_id',
        'trip_date',
        'deadline',
        'your_ref',
        'our_ref',
        'tc_id',
        'invoice_no',
        'sales_date',
        'ticket_amt',
        'rebate',
        'is_draft',
        'company_id'
    ];


    public function customer()
    {
        return $this->belongsTo( MasterCustomer::class, 'customer_id', 'id' );
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($sales) {
            $input = Request::all();
            $input['sales_id'] = $sales->id;


            // Save Trx Sales Credit Card
            $credit = new TrxSalesCreditCard();
            $credit->trx_sales_id = $sales->id;
            $credit->card_type = $input['card_type'];
            $credit->card_no = $input['card_no'];
            $credit->cardholder_name = $input['cardholder_name'];
            $credit->expiry_date = $input['expiry_date'];
            $credit->security_id = $input['security_id'];
            $credit->merchant_no = $input['merchant_no'];
            $credit->roc_no = $input['roc_no'];
            $credit->amount = $input['amount'];
            $credit->sof_flag = $input['sof_flag'];
            $credit->authorisation_code = $input['authorisation_code'];
            $credit->authorisation_date = $input['authorisation_date'];

            $credit->save();

            // Save Trx Billing 
            $billing = new TrxSalesBilling();
            $billing->trx_sales_id = $sales->id;
            $billing->ta_no = $input['ta_no'];
            $billing->cc_id = $input['cc_id'];
            $billing->purpose_code = $input['purpose_code'];
            $billing->prcj_no = $input['prcj_no'];
            $billing->department = $input['department'];
            $billing->employee_no = $input['employee_no'];
            $billing->account_no = $input['account_no'];
            $billing->job_title = $input['job_title'];

            $billing->save();


            $salesDetail = \DB::table('temporaries')->whereType('sales-detail')
            ->whereUserId(user_info('id'))
            ->get();
            // dd($salesDetail);
            if (count($salesDetail) > 0) {

                foreach ($salesDetail as $data) {
                    $detailData = json_decode($data->data);
                    $trx = new TrxSalesDetail;
                    // dd($detailData);
                    $trx->trx_sales_id = $sales->id;
                    $trx->product_code = $detailData->product_code;
                    $trx->passenger_class_code = $detailData->passenger_class_code;
                    $trx->is_group_flag = $detailData->is_group_flag;
                    $trx->is_suppress_flag = $detailData->is_suppress_flag;
                    $trx->is_pax_sup = $detailData->is_pax_sup;
                    $trx->is_group_item = $detailData->is_group_item;
                    $trx->pnr_no = $detailData->pnr_no;
                    $trx->dk_no = $detailData->dk_no;
                    $trx->airline_from = $detailData->airline_from;
                    $trx->sales_type = $detailData->sales_type;
                    $trx->sales_detail_remark = $detailData->sales_detail_remark;
                    $trx->confirm_by = $detailData->confirm_by;
                    $trx->confirm_date = $detailData->confirm_date;
                    $trx->mpd_no = $detailData->mpd_no;

                    $trx->save();

                    $temp_routing = \DB::table('temporaries')->where('type', 'routing-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_routing) > 0) {
                        foreach ($temp_routing as $data) {
                            $dataRouting = json_decode($data->data);
                            $routing = new TrxSalesDetailRouting;
                            $routing->trx_sales_detail_id = $trx->id;
                            $routing->city_from_id = $dataRouting->city_from_id;
                            $routing->city_to_id = $dataRouting->city_to_id;
                            $routing->airline_id = $dataRouting->airline_id;
                            $routing->passenger_class_id = $dataRouting->passenger_class_id;
                            $routing->depart_date = $dataRouting->depart_date;
                            $routing->arrival_date = $dataRouting->arrival_date;
                            $routing->stopover_count = $dataRouting->stopover_count;
                            $routing->airline_pnr = $dataRouting->airline_pnr;
                            $routing->fly_hr = $dataRouting->fly_hr;
                            $routing->meal_srv = $dataRouting->meal_srv;
                            $routing->ssr = $dataRouting->ssr;
                            $routing->sector_pair = $dataRouting->sector_pair;
                            $routing->path_code = $dataRouting->path_code;
                            $routing->land_sector_desc = $dataRouting->land_sector_desc;
                            $routing->operating_carrier_id = $dataRouting->operating_carrier_id;
                            $routing->flight_no = $dataRouting->flight_no;
                            $routing->flight_status = $dataRouting->flight_status;
                            $routing->equip = $dataRouting->equip;
                            $routing->seat_no = $dataRouting->seat_no;
                            $routing->terminal = $dataRouting->terminal;
                            $routing->mileage = $dataRouting->mileage;
                            $routing->land_sector_flag = $dataRouting->land_sector_flag;
                            $routing->stopover = $dataRouting->stopover;
                            $routing->nuc = $dataRouting->nuc;
                            $routing->roe = $dataRouting->roe;

                            $routing->save();
                        }
                    }

                    $temp_mis = \DB::table('temporaries')->where('type', 'mis-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_mis) > 0) {
                        foreach ($temp_mis as $data) {
                            $dataMis = json_decode($data->data);
                            $mis = new TrxSalesDetailMis;
                            $mis->trx_sales_detail_id = $trx->id;
                            $mis->lowest_fare_rejection = $dataMis->lowest_fare_rejection;
                            $mis->destination_id = $dataMis->destination_id;
                            $mis->deal_code = $dataMis->deal_code;
                            $mis->region_code_id = $dataMis->region_code_id;
                            $mis->realised_saving_code = $dataMis->realised_saving_code;
                            $mis->iata_no = $dataMis->iata_no;
                            $mis->fare_type_id = $dataMis->fare_type_id;

                            $mis->save();
                        }
                    }

                    $temp_cost = \DB::table('temporaries')->where('type', 'cost-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_cost) > 0) {
                        foreach ($temp_cost as $data) {
                            $dataCost = json_decode($data->data);
                            $cost = new TrxSalesDetailCost;
                            $cost->trx_sales_detail_id = $trx->id;
                            $cost->pay_amt = $dataCost->pay_amt;
                            $cost->currency_code_id = $dataCost->currency_code_id;
                            $cost->supplier_reference_id = $dataCost->supplier_reference_id;
                            $cost->voucher_reference_id = $dataCost->voucher_reference_id;

                            $cost->save();
                        }
                    }

                    $temp_price = \DB::table('temporaries')->where('type', 'price-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_price) > 0) {
                        foreach ($temp_price as $data) {
                            $dataPrice = json_decode($data->data);
                            $price = new TrxSalesDetailCost;
                            $price->trx_sales_detail_id = $trx->id;
                            $price->description = $dataPrice->description;
                            $price->billing_currency_id = $dataPrice->billing_currency_id;
                            $price->gst_id = $dataPrice->gst_id;
                            $price->gst_percent = $dataPrice->gst_percent;
                            $price->gst_amt = $dataPrice->gst_amt;
                            $price->rebate_percent = $dataPrice->rebate_percent;
                            $price->rebate_amt = $dataPrice->rebate_amt;

                            $price->save();
                        }
                    }

                    $temp_segment = \DB::table('temporaries')->where('type', 'segment-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_segment) > 0) {
                        foreach ($temp_segment as $data) {
                            $dataSegment = json_decode($data->data);
                            $segment = new TrxSalesDetailSegment;
                            $segment->trx_sales_detail_id = $dataSegment->trx_sales_detail_id;
                            $segment->description = $dataSegment->description;
                            $segment->start_date = $dataSegment->start_date;
                            $segment->end_date = $dataSegment->end_date;
                            $segment->start_description = $dataSegment->start_description;
                            $segment->end_description = $dataSegment->end_description;
                            $segment->status = $dataSegment->status;

                            $segment->save();

                        }
                    }

                    $temp_segment = \DB::table('temporaries')->where('type', 'segment-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_segment) > 0) {
                        foreach ($temp_segment as $data) {
                            $dataSegment = json_decode($data->data);
                            $segment = new TrxSalesDetailSegment;
                            $segment->trx_sales_detail_id = $trx->id;
                            $segment->passenger_name = $dataSegment->passenger_name;
                            $segment->ticket_no = $dataSegment->ticket_no;
                            $segment->conj_ticket_no = $dataSegment->conj_ticket_no;

                            $segment->save();
                        }
                    }
                }
            }
        });

        self::saved(function($sales) {
            $input = Request::all();
            $input['sales_id'] = $sales->id;

                            // Save Trx Sales Credit Card
            $credit = TrxSalesCreditCard::where('trx_sales_id', $sales->id)->first();
            $credit->trx_sales_id = $sales->id;
            $credit->card_type = $input['card_type'];
            $credit->card_no = $input['card_no'];
            $credit->cardholder_name = $input['cardholder_name'];
            $credit->expiry_date = $input['expiry_date'];
            $credit->security_id = $input['security_id'];
            $credit->merchant_no = $input['merchant_no'];
            $credit->roc_no = $input['roc_no'];
            $credit->amount = $input['amount'];
            $credit->sof_flag = $input['sof_flag'];
            $credit->authorisation_code = $input['authorisation_code'];
            $credit->authorisation_date = $input['authorisation_date'];

            $credit->save();

                            // Save Trx Billing 
            $billing = TrxSalesBilling::where('trx_sales_id', $sales->id)->first();
            $billing->trx_sales_id = $sales->id;
            $billing->ta_no = $input['ta_no'];
            $billing->cc_id = $input['cc_id'];
            $billing->purpose_code = $input['purpose_code'];
            $billing->prcj_no = $input['prcj_no'];
            $billing->department = $input['department'];
            $billing->employee_no = $input['employee_no'];
            $billing->account_no = $input['account_no'];
            $billing->job_title = $input['job_title'];

            $billing->save();


            $salesDetail = \DB::table('temporaries')->whereType('sales-detail')
            ->whereUserId(user_info('id'))
            ->get();
            if (count($salesDetail) > 0) {
                $salesDelete = TrxSalesDetail::where('trx_sales_id', $sales->id)->delete();
                foreach ($salesDetail as $data) {
                    $detailData = json_decode($data->data);
                    $trx = new TrxSalesDetail;
                    $trx->trx_sales_id = $sales->id;
                    $trx->product_code = $detailData->product_code;
                    $trx->passenger_class_code = $detailData->passenger_class_code;
                    $trx->is_group_flag = $detailData->is_group_flag;
                    $trx->is_suppress_flag = $detailData->is_suppress_flag;
                    $trx->is_pax_sup = $detailData->is_pax_sup;
                    $trx->is_group_item = $detailData->is_group_item;
                    $trx->pnr_no = $detailData->pnr_no;
                    $trx->dk_no = $detailData->dk_no;
                    $trx->airline_from = $detailData->airline_from;
                    $trx->sales_type = $detailData->sales_type;
                    $trx->sales_detail_remark = $detailData->sales_detail_remark;
                    $trx->confirm_by = $detailData->confirm_by;
                    $trx->confirm_date = $detailData->confirm_date;
                    $trx->mpd_no = $detailData->mpd_no;

                    $trx->save();

                    $temp_routing = \DB::table('temporaries')->where('type', 'routing-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_routing) > 0) {
                        foreach ($temp_routing as $data) {
                            $dataRouting = json_decode($data->data);
                            $routing = new TrxSalesDetailRouting;
                            $routing->trx_sales_detail_id = $trx->id;
                            $routing->city_from_id = $dataRouting->city_from_id;
                            $routing->city_to_id = $dataRouting->city_to_id;
                            $routing->airline_id = $dataRouting->airline_id;
                            $routing->passenger_class_id = $dataRouting->passenger_class_id;
                            $routing->depart_date = $dataRouting->depart_date;
                            $routing->arrival_date = $dataRouting->arrival_date;
                            $routing->stopover_count = $dataRouting->stopover_count;
                            $routing->airline_pnr = $dataRouting->airline_pnr;
                            $routing->fly_hr = $dataRouting->fly_hr;
                            $routing->meal_srv = $dataRouting->meal_srv;
                            $routing->ssr = $dataRouting->ssr;
                            $routing->sector_pair = $dataRouting->sector_pair;
                            $routing->path_code = $dataRouting->path_code;
                            $routing->land_sector_desc = $dataRouting->land_sector_desc;
                            $routing->operating_carrier_id = $dataRouting->operating_carrier_id;
                            $routing->flight_no = $dataRouting->flight_no;
                            $routing->flight_status = $dataRouting->flight_status;
                            $routing->equip = $dataRouting->equip;
                            $routing->seat_no = $dataRouting->seat_no;
                            $routing->terminal = $dataRouting->terminal;
                            $routing->mileage = $dataRouting->mileage;
                            $routing->land_sector_flag = $dataRouting->land_sector_flag;
                            $routing->stopover = $dataRouting->stopover;
                            $routing->nuc = $dataRouting->nuc;
                            $routing->roe = $dataRouting->roe;

                            $routing->save();
                        }
                    }

                    $temp_mis = \DB::table('temporaries')->where('type', 'mis-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_mis) > 0) {
                        foreach ($temp_mis as $data) {
                            $dataMis = json_decode($data->data);
                            $mis = new TrxSalesDetailMis;
                            $mis->trx_sales_detail_id = $trx->id;
                            $mis->lowest_fare_rejection = $dataMis->lowest_fare_rejection;
                            $mis->destination_id = $dataMis->destination_id;
                            $mis->deal_code = $dataMis->deal_code;
                            $mis->region_code_id = $dataMis->region_code_id;
                            $mis->realised_saving_code = $dataMis->realised_saving_code;
                            $mis->iata_no = $dataMis->iata_no;
                            $mis->fare_type_id = $dataMis->fare_type_id;

                            $mis->save();
                        }
                    }

                    $temp_cost = \DB::table('temporaries')->where('type', 'cost-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_cost) > 0) {
                        foreach ($temp_cost as $data) {
                            $dataCost = json_decode($data->data);
                            $cost = new TrxSalesDetailCost;
                            $cost->trx_sales_detail_id = $trx->id;
                            $cost->pay_amt = $dataCost->pay_amt;
                            $cost->currency_code_id = $dataCost->currency_code_id;
                            $cost->supplier_reference_id = $dataCost->supplier_reference_id;
                            $cost->voucher_reference_id = $dataCost->voucher_reference_id;

                            $cost->save();
                        }
                    }

                    $temp_price = \DB::table('temporaries')->where('type', 'price-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_price) > 0) {
                        foreach ($temp_price as $data) {
                            $dataPrice = json_decode($data->data);
                            $price = new TrxSalesDetailCost;
                            $price->trx_sales_detail_id = $trx->id;
                            $price->description = $dataPrice->description;
                            $price->billing_currency_id = $dataPrice->billing_currency_id;
                            $price->gst_id = $dataPrice->gst_id;
                            $price->gst_percent = $dataPrice->gst_percent;
                            $price->gst_amt = $dataPrice->gst_amt;
                            $price->rebate_percent = $dataPrice->rebate_percent;
                            $price->rebate_amt = $dataPrice->rebate_amt;

                            $price->save();
                        }
                    }

                    $temp_segment = \DB::table('temporaries')->where('type', 'segment-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_segment) > 0) {
                        foreach ($temp_segment as $data) {
                            $dataSegment = json_decode($data->data);
                            $segment = new TrxSalesDetailSegment;
                            $segment->trx_sales_detail_id = $dataSegment->trx_sales_detail_id;
                            $segment->description = $dataSegment->description;
                            $segment->start_date = $dataSegment->start_date;
                            $segment->end_date = $dataSegment->end_date;
                            $segment->start_description = $dataSegment->start_description;
                            $segment->end_description = $dataSegment->end_description;
                            $segment->status = $dataSegment->status;

                            $segment->save();

                        }
                    }

                    $temp_segment = \DB::table('temporaries')->where('type', 'segment-detail')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($data->id)
                    ->get();
                    if (count($temp_segment) > 0) {
                        foreach ($temp_segment as $data) {
                            $dataSegment = json_decode($data->data);
                            $segment = new TrxSalesDetailSegment;
                            $segment->trx_sales_detail_id = $trx->id;
                            $segment->passenger_name = $dataSegment->passenger_name;
                            $segment->ticket_no = $dataSegment->ticket_no;
                            $segment->conj_ticket_no = $dataSegment->conj_ticket_no;

                            $segment->save();
                        }
                    }
                }
            }
        });
    }

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('SO')->first();
        if ($result) {
            $lastNumber = (int) substr($result->sales_no, strlen($result->sales_no) - 4, 4);
            $newNumber = $lastNumber + 1;
            
            if (strlen($newNumber) == 1) {
                $newNumber = '000'.$newNumber;
            } elseif (strlen($newNumber) == 2) {
                $newNumber = '00'.$newNumber;
            } elseif (strlen($newNumber) == 3) {
                $newNumber = '0'.$newNumber;
            } else {
                $newNumber = $newNumber;
            }

            $currMonth = (int)date('m', strtotime($result->sales_no));
            $currYear = (int)date('y', strtotime($result->sales_no));
            $nowMonth = (int)date('m');
            $nowYear = (int)date('y');

            if ( ($currMonth < $nowMonth && $currYear == $nowYear) || ($currMonth == $nowMonth && $currYear < $nowYear) ) {
                $newNumber = '0001';
            } else {
                $newNumber = $newNumber;
            }

            $newCode = $findCode->type.$newNumber;
        } else {
            $newCode = $findCode->type.'0001';
        }

        return $newCode;
    }
}
