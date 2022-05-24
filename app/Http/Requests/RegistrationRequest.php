<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'file' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama terlalu panjang, maksimal 100 karakter',
            'email.required' => 'Masukan email dengan benar', 
            'email.email' => 'Masukan email dengan benar',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Password tidak boleh kosong', 
            'file.required' => 'ID Card tidak boleh kosong', 
            'file.image' => 'Upload ID Card dalam bentuk gambar', 
        ];
    }
}
