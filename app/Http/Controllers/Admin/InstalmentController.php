<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Installment;
use FileServices;
use Illuminate\Http\Request;

class InstalmentController extends AdminController
{
    protected $instalment, $fileServices;
    public function __construct()
    {
        $this->instalment = new Installment();
        $this->fileServices = new FileServices();
    }
    protected function getInstalments($condition = [])
    {
        return $this->instalment->where($condition)->latest()->get();
    }
    protected function storeInstalment($request)
    {
        return $this->instalment->create($request->validated() + $this->uploadImageInstallment($request));
    }
    protected function updateInstalment($request)
    {
        return $this->instalment->find($request->instalment_id)->update($request->validated() + $this->uploadImageInstallment($request));
    }
    protected function uploadImageInstallment($request)
    {
        return $request->file('file') ? ['image' => $this->fileServices->upload($request->file('file'))] : [];
    }
    protected function deleteInstalment($id)
    {
        return $this->instalment->where('id', $id)->delete();
    }
    protected function updateInstalmentStatus($request)
    {
        return $this->instalment->where('id', $request->id)->update(['status' => $request->status]);
    }
}
