<?php

namespace App\Http\Requests;

use App\Models\Settings;
use App\Rules\MaxLengtOfLoan;
use Illuminate\Foundation\Http\FormRequest;

class LoanStoreRequest extends FormRequest
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
            'nominal' => 'required',
            'length_of_loan' => ['required', new MaxLengtOfLoan],
        ];
    }

    public function messages()
    {
        return [ 
            'nominal.required' => 'Masukan jumlah pinjaman yang akan diajukan',
            'length_of_loan.required' => 'Masukan tenor pinjaman yang akan diajukan',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'nominal' => str_replace('.','', $this->nominal),
        ]);
    }
}
