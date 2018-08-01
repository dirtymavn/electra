<?php

namespace App\Http\Requests\Outbound;

use Illuminate\Foundation\Http\FormRequest;

class TourOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'order_type' => 'required',
            'trip_date' => 'required',
            'deadline' => 'required',
            'your_ref' => 'required',
            'our_ref' => 'required',
            'master_tour_id' => 'required',
            'days' => 'required'
        ];
    }
}
