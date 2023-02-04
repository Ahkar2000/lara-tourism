<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'name' => 'required|min:5|max:50|unique:packages,name',
            'category' => 'required|exists:categories,id',
            'location' => 'required|min:10',
            'price' => 'required|numeric|min:1',
            'description' => 'required|min:20',
            'photos' => 'required',
            'photos.*' => 'mimes:png,jpg,jpeg'
        ];
    }
}
