<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanStoreRequest;
use App\Models\Loan;
use App\Models\LoanRecommendations;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->auth = Auth::guard('user');
    }

    public function index(LoanRecommendations $loanRecommendation, Request $request, Settings $setting)
    {
        return view('dashboard.loan.index', ['loan_recommendation' => $this->loanRecommendation($loanRecommendation, $request), 'setting' => $setting->first()]);
    }

    public function store(LoanStoreRequest $loanStoreRequest, Loan $loan, Settings $setting)
    {
        return $loan->create($this->storeData($loanStoreRequest, $setting)) ? redirect(route('loan_history'))->with('Berhasil mengajukan pinjaman, silakan tunggu sampai permintaan disetujui') : back()->withErrors('Gagal melakukan peminjaman, silakan hubungi admin sekarang');
    }

    protected function storeData($loanStoreRequest, $setting)
    {
        return $loanStoreRequest->validated() + ['interest_rate' => $setting->first()->interest_rate, 'user_id' => $this->auth->user()->id];
    }

    protected function loanRecommendation($loanRecommendation, $request)
    {
        return $request->id ? $loanRecommendation->where('id', $request->id)->firstOrfail() : null;
    }
}
