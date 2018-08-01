<?php

namespace App\Http\Requests\MasterData\Outbound;

use Illuminate\Foundation\Http\FormRequest;

class ItinRequest extends FormRequest
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
            // 'itinerary_code' => 'required',
            // 'itinerary_direction' => 'required',
            'itinerary_name' => 'required',
        ];
    }
}
