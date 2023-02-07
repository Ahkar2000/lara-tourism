<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'new_model' => 'required|min:3',
            'new_driver' => 'required|min:3',
            'new_seat' => 'required|min:1|numeric',
            'new_status' => 'required',
            'new_price' => 'required|numeric|min:1'
        ];
    }
}
