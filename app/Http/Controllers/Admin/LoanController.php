<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Loan;
use App\Models\Settings;
use Illuminate\Http\Request;

class LoanController extends AdminController
{
    protected $loans, $setting;
    public function __construct()
    {
        $this->loans = new Loan();
        $this->setting = new Settings();
    }

    protected function getLoans($condition = [])
    {
        return $this->loans->where($condition)->latest()->get();
    }

    protected function getLoan($id)
    {
        return $this->loans->where('id', $id)->firstOrFail();
    }

    protected function deleteLoan($id)
    {
        return $this->loans->where('id', $id)->delete();   
    }

    protected function changeStatusLoan($request)
    {
        return $this->loans->where('id', $request->id)->update(['status' => $request->status] + $this->setAccAt($request));
    }

    protected function setAccAt($request)
    {
        return $request->status == 1 ? ['acc_at' => now()] : [];
    }

    protected function updateLoanSetting($request)
    {
        return $this->setting->whereNotNull('id')->update($request->validated());
    }
}
