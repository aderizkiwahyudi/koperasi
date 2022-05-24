<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanHistoryController extends Controller
{
    public function __construct()
    {
        $this->loan = new Loan();
    }

    public function index()
    {
        return view('dashboard.loan.history', ['loans' => $this->getLoans()]);
    }

    public function detail(Request $request)
    {
        return view('dashboard.loan.history', ['loans' => $this->getLoan($request)]);
    }

    protected function getLoans()
    {
        return $this->loan->where('user_id', auth('user')->user()->id)->get();
    }

    protected function getLoan($request)
    {
        return $this->loan->where('user_id', auth('user')->user()->id)->where('id', $request->id)->get();
    }
}
