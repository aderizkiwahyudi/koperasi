<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.setting.index');
    }

    public function update(UserUpdateRequest $userUpdateRequest, User $user)
    {
        return $user->find(auth('user')->user()->id)->update($userUpdateRequest->validated() + ['password' => $userUpdateRequest->password ?? auth('user')->user()->password]) ? back()->with('success', 'Berhasil menyimpan pengaturan') : abort(404);
    }
}
