<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ForgetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->uniqueEmail($request);
    }

    public function view()
    {
        return view('forget-password');
    }

    protected function uniqueEmail($request)
    {
        return User::where('email', $request->email)->first() ? $this->store($request) : back()->withErrors('Email tidak ditemukan');
    }

    protected function store($request)
    {
        $request->token = rand(999,999999999999) . time();
        return PasswordReset::create(['email' => $request->email, 'token' => $request->token, 'created_at' => now()]) ? $this->sendEmailResetPassword($request) : back()->withErrors('Terjadi Kesalahan, silakan coba kembali');
    }

    protected function sendEmailResetPassword($request)
    {
        return Mail::to($request->email)->send(new SendEmailResetPassword($request)) ? $this->flashSession() : back()->withErrors('Gagal mengirim email, silakan coba lagi');
    }

    protected function flashSession()
    {
        return back()->with('success', 'Berhasil mengirim email, jika email tidak ditemukan coba untuk ke menu spam.');
    }
}
