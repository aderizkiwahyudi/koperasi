<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstalmentRequest;
use App\Models\Installment;
use App\Models\Loan;
use FileServices;
use Illuminate\Http\Request;

class InstalmentController extends Controller
{
    protected $loan, $instalment;
    public function __construct()
    {
        $this->loan = new Loan();
        $this->instalment = new Installment();
        $this->fileServices = new FileServices();
    }
    public function index(Request $request)
    {
        return view('dashboard.instalment.index', ['loan' => $this->loan->where('id', $request->id)->first()]);
    }
    public function store(InstalmentRequest $instalmentRequest)
    {
        return $this->instalment->create($instalmentRequest->validated() + ['user_id' => auth('user')->user()->id] + $this->uploadImage($instalmentRequest)) ? redirect()->route('loan_history.detail', $instalmentRequest->id)->with('success', 'Berhasil menambahkan pembayaran') : back()->withErrors('Terjadi kesalahan, silakan huubi admin');
    }
    protected function uploadImage($request)
    {
        return $request->file('file') ? ['image' => $this->fileServices->upload($request->file('file'))] : [];
    }
}
