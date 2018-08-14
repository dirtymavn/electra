<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class IURController extends Controller
{
    public function upload(Request $request){
        set_time_limit(0);
        $validator = Validator::make($request->all(), [
            'iur' => 'required|mimes:txt',
        ]);

        if ($validator->fails()) {
            return response()->default(400, $validator);
        }
        try{
            $upload = upload_file($request->iur, 'upload/iur/', 'file');
            $data=$this->convertIUR($upload['original']);
            return view('contents.master_datas.iur.create', $data);
        }catch(\Exception $ex){
            die($ex->getMessage());
        }
    }

    public function convertIUR($path){
        $inv = text_to_array($path);
        $data = [
            'header' => [],
            'passenger' => [],
            'itinerary' => [],
            'misc' => []
        ];
        foreach ($inv as $k => $val) {
            $key = substr($val, 0, 2);
            switch ($key) {
                case 'AA':
                    $invoice_data = $this->getConstantData($val);
                    if (!array_key_exists('constant_data', $data['header'])) {
                        $data['header']['constant_data'][] = $invoice_data;
                    } else {
                        array_push($data['header']['constant_data'], $invoice_data);
                    }

                    break;

                case 'M1':
                    $invoice_data = $this->getInvoiceData($val);
                    if (!array_key_exists('invoice_data', $data['passenger'])) {
                        $data['passenger']['invoice_data'][] = $invoice_data;
                    } else {
                        array_push($data['passenger']['invoice_data'], $invoice_data);
                    }

                    break;

                case 'M2':
                    $ticket_data = $this->getTicketData($val);
                    if (!array_key_exists('ticket_data', $data['passenger'])) {
                        $data['passenger']['ticket_data'][] = $ticket_data;
                    } else {
                        array_push($data['passenger']['ticket_data'], $ticket_data);
                    }

                    break;

                case 'M3':
                    $itinerary_data = $this->getItineraryData($val);
                    if (!array_key_exists('itinerary_data', $data['itinerary'])) {
                        $data['itinerary']['itinerary_data'][] = $itinerary_data;
                    } else {
                        array_push($data['itinerary']['itinerary_data'], $itinerary_data);
                    }
                    break;

                case 'M4':
                    $entitlement_data = $this->getEntitlementData($val);
                    if (!array_key_exists('entitlement_data', $data['itinerary'])) {
                        $data['itinerary']['entitlement_data'][] = $entitlement_data;
                    } else {
                        array_push($data['itinerary']['entitlement_data'], $entitlement_data);
                    }

                    break;

                case 'M5':
                    $accounting_data = $this->getAccountingData($val);
                    if (!array_key_exists('accounting_data', $data['itinerary'])) {
                        $data['itinerary']['accounting_data'][] = $accounting_data;
                    } else {
                        array_push($data['itinerary']['accounting_data'], $accounting_data);
                    }

                    break;

                case 'M6':
                    $fare_calculation = $this->getFareCalculationData($val);
                    if (!array_key_exists('fare_calculation', $data['itinerary'])) {
                        $data['itinerary']['fare_calculation'][] = $fare_calculation;
                    } else {
                        array_push($data['itinerary']['fare_calculation'], $fare_calculation);
                    }

                    break;

                case 'M7':
                    $itinerary_remarks = $this->getItineraryRemarksData($val);
                    if (!array_key_exists('itinerary_remarks', $data['misc'])) {
                        $data['misc']['itinerary_remarks'][] = $itinerary_remarks;
                    } else {
                        array_push($data['misc']['itinerary_remarks'], $itinerary_remarks);
                    }
                    break;

                case 'M8':
                    $invoice_remarks = $this->getInvoiceRemarksData($val);
                    if (!array_key_exists('invoice_remarks', $data['misc'])) {
                        $data['misc']['invoice_remarks'][] = $invoice_remarks;
                    } else {
                        array_push($data['misc']['invoice_remarks'], $invoice_remarks);
                    }
                    break;

                case 'M9':
                    if (!array_key_exists('message_remarks', $data['misc'])) {
                        $data['misc']['message_remarks'][] = $this->getInterfaceMessageRemarks($val);
                    } else {
                        array_push($data['misc']['message_remarks'], $this->getInterfaceMessageRemarks($val));
                    }

                    break;

                case 'MA':
                    if (!array_key_exists('airline_fees', $data['misc'])) {
                        $data['misc']['airline_fees'][] = $this->getAirlineFees($val);
                    } else {
                        array_push($data['misc']['airline_fees'], $this->getAirlineFees($val));
                    }

                    break;

                case 'MB':
                    if (!array_key_exists('misc_charge', $data['misc'])) {
                        $data['misc']['misc_charge'][] = $this->getMiscellaneousCharge($val);
                    } else {
                        array_push($data['misc']['misc_charge'], $this->getMiscellaneousCharge($val));
                    }

                    break;

                case 'MC':
                    if (!array_key_exists('ticket_advice_record', $data['misc'])) {
                        $data['misc']['ticket_advice_record'][] = $this->getTicketAdviceRecord($val);
                    } else {
                        array_push($data['misc']['ticket_advice_record'], $this->getTicketAdviceRecord($val));
                    }

                    break;

                case 'MD':
                    if (!array_key_exists('tour_order_record', $data['misc'])) {
                        $data['misc']['tour_order_record'][] = $this->getTourOrderRecord($val);
                    } else {
                        array_push($data['misc']['tour_order_record'], $this->getTourOrderRecord($val));
                    }

                    break;

                case 'ME':
                    if (!array_key_exists('associated_remarks', $data['misc'])) {
                        $data['misc']['associated_remarks'][] = $this->getSegmentedAssociatedRemarksRecord($val);
                    } else {
                        array_push($data['misc']['associated_remarks'], $this->getSegmentedAssociatedRemarksRecord($val));
                    }

                    break;

                case 'MF':
                    if (!array_key_exists('email_address', $data['misc'])) {
                        $data['misc']['email_address'][] = $this->getPassengerEmailAddress($val);
                    } else {
                        array_push($data['misc']['email_address'], $this->getPassengerEmailAddress($val));
                    }

                    break;

                case 'MG':
                    if (!array_key_exists('emd', $data['misc'])) {
                        $data['misc']['emd'][] = $this->getElectronicMiscellaneousDocument($val);
                    } else {
                        array_push($data['misc']['emd'], $this->getElectronicMiscellaneousDocument($val));
                    }

                    break;

                case 'MX':
                    if (!array_key_exists('expansion_record', $data['misc'])) {
                        $data['misc']['expansion_record'][] = $this->getExpansionRecord($val);
                    } else {
                        array_push($data['misc']['expansion_record'], $this->getExpansionRecord($val));
                    }

                    break;

                case 'MY':
                    if (!array_key_exists('misc_records', $data['misc'])) {
                        $data['misc']['misc_records'][] = $this->getMiscellaneousRecord($val);
                    } else {
                        array_push($data['misc']['misc_records'], $this->getMiscellaneousRecord($val));
                    }

                    break;
            }

        }

        return $data;
    }
    public function index(){
        $data=[
            'header'=>[],
            'passenger'=>[],
            'itinerary'=>[],
            'misc'=>[]
        ];
        return view('contents.master_datas.iur.create',$data);

    }

    /**
     * Generate M0
     *
     * @return array
     */
    protected function getConstantData($str){
        $data = [
            'transmission_header' => substr($str, 0, 11),
            'origination_code' => substr($str, 0, 2),
            'day' => substr($str, 2, 2),
            'month' => substr($str, 4, 3),
            'time' => substr($str, 7, 4),
            'message_id' => substr($str, 11, 2),
            'transaction_type' => substr($str, 13, 1),
            'interface_version_number' => substr($str, 14, 2),
            'customer_number' => substr($str, 16, 10),
            'customer_branch' => substr($str, 16, 3),
            'customer_number2' => substr($str, 19, 7),
            'spare' => substr($str, 26, 5),
            'previously_invoiced_indicator' => substr($str, 31, 1),
            'pnr_record_control_check' => substr($str, 32, 2),
            'type_of_queue_processing' => substr($str, 34, 1),
        ];

        return $data;   
    }
    /**
     * Generate M1
     *
     * @return array
     */
    protected function getInvoiceData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'no'=> substr($str,2,2),
            'passenger_name' => substr($str, 4, 64),
            'passenger_man_number' => substr($str, 68, 30),
            'advantage' => substr($str, 98, 1),
            'traveller_number' => substr($str, 99, 20),
            'traveller_membership' => substr($str, 119, 5),
            'number_of_itineraries' => substr($str, 124, 2),
            'name_ticketing' => substr($str, 126, 1),
            'spare' => substr($str, 127, 1),
            'number_of_acctg' => substr($str, 128, 2),
            'number_of_itinerary_remark' => substr($str, 130, 2),
            'number_of_invoice_remark' => substr($str, 132, 2),
            'number_of_interface_remark' => substr($str, 134, 2),
            'reserved_for_future_use' => substr($str, 136, 2),
            'cariage_return' => substr($str, 138, 1)
        ];

        return $data;
    }

    /**
     * Generate M2
     *
     * @return array
     */

    protected function getTicketData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'no' => substr($str, 2, 2),
            'passenger_type' => substr($str, 4, 3),
            'tcn_number' => substr($str, 7, 11),
            'international_itinerary_indicator' => substr($str, 18, 1),
            'form_of_payment' => substr($str, 19, 1),
            'ticket_indicator' => substr($str, 20, 1),
            'atb_print_sequences' => substr($str, 21, 1),
            'combined_ticket' => substr($str, 22, 1),
            'ticket_only' => substr($str, 23, 1),
            'boarding_pass_only' => substr($str, 24, 1),
            'remote_print_auditors' => substr($str, 25, 1),
            'passenger_receipt' => substr($str, 26, 1),
            'remote_print_agents' => substr($str, 27, 1),
            'remote_print_agents' => substr($str, 28, 1),
            'remote_print_cc' => substr($str, 29, 1),
            'invoice_document' => substr($str, 30, 1),
            'mini_itinerari' => substr($str, 31, 1),
            'magnetic_encoding' => substr($str, 19, 1),
            'wholesale' => substr($str, 20, 1),
            'bsp_ticket' => substr($str, 21, 1),
            'fare_sign' => substr($str, 22, 1),
            'fare_area' => substr($str, 23, 11),
            'fare_currency_code' => substr($str, 34, 3),
            'fare_amount' => substr($str, 37, 8),
            'tax_1_sign' => substr($str, 45, 1),
            'tax_1_amount' => substr($str, 46, 7),
            'tax_1_id' => substr($str, 53, 2),
            'tax_2_sign' => substr($str, 55, 1),
            'tax_2_amount' => substr($str, 56, 7),
            'tax_2_id' => substr($str, 63, 2),
            'tax_3_sign' => substr($str, 65, 1),
            'tax_3_amount' => substr($str, 66, 7),
            'tax_3_id' => substr($str, 73, 2),
            'total_fare_sign' => substr($str, 77, 1),
            'total_fare_area' => substr($str, 78, 11),
            'total_fare_currency_code' => substr($str, 89, 3),
            'total_fare_amount' => substr($str, 92, 8),
        ];

        return $data;
    }

    /**
     * Generate M3
     *
     * @return array
     */
    protected function getItineraryData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'no'=>substr($str,2,2),
            'product_code'=>substr($str,4,1),
            'link_code'=>substr($str,5,1),
            'control_data'=>substr($str,6,1),
            'action_advice'=>substr($str,7,2),
            'departure_date'=>substr($str,9,5),
            'secondary_product_code'=>substr($str,14,3),
            'issue_boarding_pass'=>substr($str,17,1),
            'departure_city_code'=>substr($str,18,3),
            'departure_city_name'=>substr($str,21,17),
            'arrival_city_code'=>substr($str,38,3),
            'arrival_city_name'=>substr($str,41,17),
            'carrier_code'=>substr($str,58,2),
            'flight_number'=>substr($str,60,5),
            'class_of_service'=>substr($str,65,2),
            'departure_time'=>substr($str,67,5),
            'arrival_time'=>substr($str,72,5),
            'elapsed_flying_time'=>substr($str,77,8),
            'meal_service_indicator'=>substr($str,85,4),
            'supplemental_information'=>substr($str,89,1),
            'flight_arrival_date_change_indicator'=>substr($str,90,1),
            'number_of_stop'=>substr($str,91,1),
            'stop_over_city_codes'=>substr($str,92,18),
            'carrier_type_code'=>substr($str,110,2),
            'equipment_type_code'=>substr($str,112,3),
            'statute_miles'=>substr($str,115,6),
            'frequent_traveler_miles'=>substr($str,121,6),
            'pre_reserved_seat_counter'=>substr($str,127,2),
            'departure_terminal'=>substr($str,129,26),
            'departure_gate'=>substr($str,155,4),
            'arrival_terminal'=>substr($str,159,26),
            'arrival_gate'=>substr($str,185,4),
            'report_time'=>substr($str,189,5),
            'change_of_gauge'=>substr($str,194,1),
            'commuter_carrier_name'=>substr($str,195,37),
            'itinerary_item_ticketing_indicator'=>substr($str,232,1),
            'special_meal_request_counter'=>substr($str,233,2),
            'flight_departure_year'=>substr($str,235,4),
            'airline_pnr_location'=>substr($str,239,8),
            'variable_data'=>substr($str,248),
        ];

        return $data;
    }
    /**
     * Generate M4
     *
     * @return array
     */
    protected function getEntitlementData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'no'=>substr($str,2,2),
            'passenger_type_code'=>substr($str,4,3),
            'connection_indicator'=>substr($str,7,1),
            'entitlement_type'=>substr($str,8,3),
            'fare_not_valid_before_date'=>substr($str,9,5),
            'fare_not_valid_after_date'=>substr($str,14,5),
            'fare_not_valid_after_date'=>substr($str,14,5),
            'status'=>substr($str,19,2),
            'weight_limit'=>substr($str,21,3),
            'fare_basis_code'=>substr($str,24,13),
            'amtrak_class_of_service'=>substr($str,37,2),
            'fare_by_leg_dollar_amount'=>substr($str,39,8),
            'electronic_ticketing_indicator'=>substr($str,47,1),
            'fare_basis_code_expanded'=>substr($str,48,12),
            'ticket_designator_expanded'=>substr($str,60,10),
            'currency_code'=>substr($str,70,3),
            'spare'=>substr($str,73,13),
            'carriage_return'=>substr($str,86,1),
        ];

        return $data;
    }
    /**
     * Generate M5
     *
     * @return array
     */
    protected function getAccountingData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'no' => substr($str, 2, 2),
            'interface_name_item_number' => substr($str, 4, 2),
            'variable_accounting_data' => substr($str, 6),
        ];
        return $data;
    }
    /**
     * Generate M6
     *
     * @return array
     */
    protected function getFareCalculationData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'passenger_type'=>substr($str,2,3),
            'fare_calculation_type'=>substr($str,5,1),
            'compress_print_indicator'=>substr($str,6,1),
            'variable_fare_calculation_data'=>substr($str,7,1),
        ];
        return $data;
    }
    /**
     * Generate M7
     *
     * @return array
     */
    protected function getItineraryRemarksData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'remark_item_number'=>substr($str,2,2),
            'variable_itinerary_remark_data'=>substr($str,4),
        ];
        return $data;
    }
    /**
     * Generate M8
     *
     * @return array
     */
    protected function getInvoiceRemarksData($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'remark_item_number' => substr($str, 2, 2),
            'variable_itinerary_remark_data' => substr($str, 4),
        ];
        return $data;
    }
    /**
     * Generate M9
     *
     * @return array
     */
    protected function getInterfaceMessageRemarks($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'remark_item_number' => substr($str, 2, 2),
            'variable_itinerary_remark_data' => substr($str, 4),
        ];
        return $data;

    }

    /**
     * Generate MA
     *
     * @return array
     */
    protected function getAirlineFees($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'passenger_sequence_number' => substr($str, 2, 2),
            'item_number_passenger' => substr($str, 4,2),
            'no_charge_indicator' => substr($str, 6,1),
            'ticket_number' => substr($str, 7,13),
            'validating_carrier' => substr($str, 20,3),
            'fee_code' => substr($str, 23,14),
            'type_of_service' => substr($str, 37,2),
            'sub_code' => substr($str, 39,3),
            'future_expansion' => substr($str, 42,3),
            'priced_ob_fee' => substr($str, 45,1),
            'iata_application_indicator' => substr($str, 46,3),
            'refund' => substr($str, 49,1),
            'commission' => substr($str, 50,1),
            'interline' => substr($str, 51,1),
            'future_expansion' => substr($str, 52,2),
            'fee_description' => substr($str, 54,25),
            'spare' => substr($str, 79,1),
            'number_of_taxes' => substr($str, 80,2),
            'fee_amount' => substr($str, 82,11),
            'currency_code' => substr($str, 93,3),
            'carriage_return' => substr($str, 96,1),
        ];
        return $data;

    }

    /**
     * Generate MB
     *
     * @return array
     */
    protected function getMiscellaneousCharge($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'associated_item_number'=>substr($str,2,2),
            'associated_passenger'=>substr($str,4,2),
            'variable_data'=>substr($str,6),
        ];
        return $data;
    }

    /**
     * Generate MC
     *
     * @return array
     */
    protected function getTicketAdviceRecord($str){
        $data = [
            'message_id'=> substr($str, 0, 2),
            'associated_item_number' => substr($str, 2, 2),
            'associated_passenger' => substr($str, 4, 2),
            'variable_data' => substr($str, 6),
        ];
        return $data;
    }

    /**
     * Generate MD
     *
     * @return array
     */
    protected function getTourOrderRecord($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'associated_item_number' => substr($str, 2, 2),
            'associated_passenger' => substr($str, 4, 2),
            'variable_data' => substr($str, 6),
        ];
        return $data;
    }

    /**
     * Generate ME
     *
     * @return array
     */
    protected function getSegmentedAssociatedRemarksRecord($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'associated_item_number' => substr($str, 2, 2),
            'variable_data' => substr($str, 4),
        ];

        return $data;
    }

    /**
     * Generate MF
     *
     * @return array
     */
    protected function getPassengerEmailAddress($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'item_number' => substr($str, 2, 2),
            'email' => substr($str, 4),
            'carriage_return' => substr($str, -1),
        ];
        return $data;

    }

    /**
     * Generate MG
     *
     * @return array
     */
    protected function getElectronicMiscellaneousDocument($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'item_number' => substr($str, 2, 2),
            'passenger_type' => substr($str, 4,3),
            'creation_local_date' => substr($str, 7,9),
            'creation_local_time' => substr($str, 16,4),
            'crs_id' => substr($str, 20,2),
            'validating_carrier_code' => substr($str, 22,2),
            'validating_carrier_code_spare' => substr($str, 24,1),
            'emd_document_number' => substr($str, 25,14),
            'airline_numeric_code' => substr($str, 39,3),
            'document_number' => substr($str, 42,10),
            'check_digit' => substr($str, 52,1),
            'conjuction_ticket_count' => substr($str, 53,1),
            'associate_ticket_number' => substr($str, 54,14),
            'airline_numeric_code' => substr($str, 68,3),
            'ticket_number' => substr($str, 71,10),
            'check_digit_2' => substr($str, 81,1),
            'emd_type_indicator' => substr($str, 82,1),
            'endorsable_indicator' => substr($str, 83,1),
            'commisionable_indicator' => substr($str, 84,1),
            'refund_indicator' => substr($str, 85,1),
            'spare_indicator' => substr($str, 86,1),
            'segment_indicator' => substr($str, 87,1),
            'fare_calculation_indicator' => substr($str, 88,1),
            'origin_of_travel' => substr($str, 89,3),
            'spare_for_origin' => substr($str, 92,2),
            'destination_of_travel' => substr($str, 94,3),
            'spare_for_destination' => substr($str, 97,2),
            'rfic_code_left' => substr($str, 99,2),
            'tour_code' => substr($str, 101,15),
            'total_dare' => substr($str, 116,21),
            'currency' => substr($str, 137,3),
            'total_fare_amount' => substr($str, 140,18),
            'total_taxes' => substr($str, 158,18),
            'total_commission' => substr($str, 176,18),
            'total_equivalent_amount' => substr($str, 194,21),
            'fop' => substr($str, 215,2),
            'cc_company_code' => substr($str, 217,2),
            'cc_company_code_spare' => substr($str, 219,1),
            'cc_number' => substr($str, 220,18),
            'cc_number_spare' => substr($str, 238,4),
            'cc_exp_number' => substr($str, 242,4),
            'cc_extended_payment_code' => substr($str, 246,4),
            'cc_authorization' => substr($str, 250,9),
            'cc_auth_code_type' => substr($str, 259,1),
            'spare' => substr($str, 260,1),
            'restrictions_indicator' => substr($str, 261,1),
            'exchange_document_number' => substr($str, 262,13),
            'spare_2' => substr($str, 275,10),
            'number_of_coupons' => substr($str, 285,2),
            'carriage_return' => substr($str, 287,1),
        ];

        return $data;

    }

    /**
     * Generate MX
     *
     * @return array
     */
    protected function getExpansionRecord($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'item_number' => substr($str, 2, 3),
            'type' => substr($str, 5, 2),
            'm2_record_number' => substr($str, 7, 2),
            'ticket_number' => substr($str, 9, 14),
            'char_spare' => substr($str, 23, 3),
            'ticket_number_2' => substr($str, 26, 10),
            'last_digit_spare' => substr($str, 36, 1),
            'taxes_type' => substr($str, 37, 3),
        ];

        return $data;
    }

    /**
     * Generate MY
     *
     * @return array
     */
    protected function getMiscellaneousRecord($str){
        $data = [
            'message_id' => substr($str, 0, 2),
            'item_number' => substr($str, 2, 3),
            'type_of_record' => substr($str, 5, 2),
            'profile_index' => substr($str, 7),
        ];
        return $data;
    }



}
