<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'interest_rate' => 'required',
            'max_length_of_loan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'insterest_rate.required' => 'Bunga pinjaman tidak boleh kosong',
            'max_length_of_loan.required' => 'Batas Tenor pinjaman tidak boleh kosong',
        ];
    }
}
