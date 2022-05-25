<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstalmentRequest extends FormRequest
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
            'loan_id' => 'exists:loans,id',
            'created_at' => '',
            'instalment_id' => '',
            'status' => '',
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => 'Nominal tidak boleh kosong',
            'created_at.required' => 'Tanggal Pembayaran tidak boleh kosong',
            'loan_id.exists' => 'Riwayat Peminjaman tidak ditemukan',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'nominal' => str_replace('.','',$this->nominal),
            'loan_id' => $this->id,
        ]);
    }
}
