<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\User;
use FileServices;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    protected $user, $fileServices;
    public function __construct()
    {
        $this->user = new User();
        $this->fileServices = new FileServices();    
    }

    protected function getUsers($condition = [])
    {
        return $this->user->where('role', 1)->where($condition)->get();
    }

    protected function getUser($id)
    {
        return $this->user->where('id', $id)->firstOrFail();
    }

    protected function storeUser($request)
    {
        return $this->user->create($request->validated() + $this->uploadIDCard($request));
    }

    protected function updateUser($request)
    {
        return $this->user->find($request->id)->update($request->validated() + $this->uploadIDCard($request) + $this->updatePassword($request));
    }

    protected function uploadIDCard($request)
    {
        return $request->file('file') ? ['id_card' => $this->fileServices->upload($request->file('file'))] : [];
    }

    protected function updatePassword($request)
    {
        return $request->password ? ['password' => $request->password] : [];
    }

    protected function deleteUser($id)
    {
        return $this->user->find($id)->delete();
    }
}
