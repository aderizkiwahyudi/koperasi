<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstalmentController extends AdminController
{
    protected $instalment;
    public function __construct()
    {
        $this->instalment = new Installment();
    }
    protected function storeInstalment($request)
    {
        return $this->instalment->create($request->validated());
    }
    protected function updateInstalment($request)
    {
        return $this->instalment->find($request->id)->update($request->validated());
    }
    protected function deleteInstalment($id)
    {
        return $this->instalment->where('id', $id)->delete();
    }
}
