<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use FileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegistrationRequest $request, FileServices $fileServices)
    {
        return User::create($request->validated() + ['id_card' => $this->handleUploadImage($fileServices, $request)]) ? back()->with('success', 'Berhasil membuat akun, silakan tunggu sampai akun anda diverifikasi') : back()->withErrors('Gagal membuat akun, silakan coba lagi');
    }

    public function view()
    {
        return view('registration');
    }

    protected function handleUploadImage($fileServices, $request)
    {
        return $fileServices->upload($request->file('file'), 'img');
    }
}