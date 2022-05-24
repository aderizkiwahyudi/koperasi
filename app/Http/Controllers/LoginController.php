<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $role, $message;
    public function __invoke(Request $request, User $user)
    {
        return $this->setRole($request, $user) ? $this->setAuth($request) : back()->withErrors('Email tidak ditemukan');
    }

    public function view()
    {
        return view('index');
    }

    protected function login()
    {
        return $this->getAuth()->status == 0 ? $this->deleteAuth('Akun anda belum aktif, silakan tunggu') : ($this->getAuth()->status == 2 ? $this->deleteAuth('Akun anda telah di nonaktif, silakan hubungi admin') : $this->handleRedirect());
    }

    protected function deleteAuth($message)
    {
        return auth($this->getRole())->logout() ? back()->withErrors('Terjadi kesalahan, silakan hubungi admin') : back()->withErrors($message);
    }

    protected function setRole($request, $user)
    {
        return $this->role = $user->where('email', $request->email)->first()->role ?? 1;
    }

    protected function getRole()
    {
        return $this->role == 1 ? 'user' : 'admin';
    }

    protected function setAuth($request)
    {
        return Auth::guard($this->getRole())->attempt(['email' => $request->email, 'password' => $request->password]) ? $this->login() : back()->withErrors('Email atau password tidak ditemukan');
    }

    protected function getAuth()
    {
        return auth($this->getRole())->user();
    }

    protected function setMessage($message)
    {
        $this->message = $message;
    }

    protected function getMessage()
    {
        return $this->message;
    }

    protected function handleRedirect()
    {
        return $this->role == 1 ? redirect(route('dashboard')) : redirect(route('admin.dashboard'));
    }
}
