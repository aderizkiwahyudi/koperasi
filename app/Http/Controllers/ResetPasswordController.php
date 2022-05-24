<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        return $this->handleAfterResetPassword($request);
    }

    public function view(PasswordReset $passwordReset, Request $request)
    {
        return $passwordReset->where('token', $request->token)->latest()->first() ? view('reset-password') : abort(404);
    }

    protected function handleAfterResetPassword($request)
    {
        return User::find($this->getEmailFromToken($request->token)->user->id)->update($request->validated()) ? $this->handleSuccessResetPassword($request) : back()->withErrors('Terjadi kesalahan, silakan coba lagi');
    }

    protected function handleSuccessResetPassword($request)
    {
        return PasswordReset::where('email', $this->getEmailFromToken($request->token)->email)->delete() ? redirect(route('login'))->with('success', 'Berhasil merubah password, silakan login') : back()->withErrors('Terjadi kesalahan 2, silakan coba lagi');
    }

    protected function getEmailFromToken($token)
    {
        return PasswordReset::where('token', $token)->first();
    }
}
