<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\InstalmentRequest;
use App\Http\Requests\LoanStoreRequest;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Loan;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(User $user, Loan $loan)
    {
        return view('admin.index', ['users' => $user->where('role', 1)->get(), 'loans' => $loan->all()]);
    }

    public function employee()
    {
        return view('admin.employees.index', ['users' => $this->getUsers()]);
    }

    public function employee_detail(Request $request)
    {
        return view('admin.employees.detail', ['user' => $this->getUser($request->id)]);
    }

    public function employee_add()
    {
        return view('admin.employees.edit');
    }

    public function employee_add_process(EditUserRequest $editUserRequest)
    {
        return $this->storeUser($editUserRequest) ? redirect()->route('admin.employee')->with('success', 'Berhasil menyimpan data') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function employee_edit(Request $request)
    {
        return view('admin.employees.edit', ['user' => $this->getUser($request->id)]);
    }

    public function employee_edit_process(EditUserRequest $editUserRequest)
    {
        return $this->updateUser($editUserRequest) ? back()->with('success', 'Berhasil menyimpan data') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function employee_delete(Request $request)
    {
        return $this->deleteUser($request->id) ? redirect()->route('admin.employee')->with('success', 'Berhasil menghapus data') : back()->withErrors('Terjadi kesalahan, silakana hubungi admin');
    }

    public function loan()
    {
        return view('admin.loans.index', ['loans' => $this->getLoans()]);
    }

    public function loan_detail(Request $request)
    {
        return view('admin.loans.detail', ['loan' => $this->getLoan($request->id)]);
    }

    public function loan_action(Request $request)
    {
        return $this->changeStatusLoan($request) ? back() : back();
    }

    public function loan_delete(Request $request)
    {
        return $this->deleteLoan($request->id) ? back()->with('success', 'Berhasil menghapus data') : back()->withErrors('Data tidak ditemukan');
    }

    public function loan_setting(Settings $settings)
    {
        return view('admin.loans.setting', ['settings' => $settings->first()]);
    }

    public function loan_setting_process(SettingRequest $settingRequest)
    {
        return $this->updateLoanSetting($settingRequest) ? back()->with('success', 'Berhasil menyimpan pengaturan') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function recommendations(Settings $settings)
    {
        return view('admin.recommendations.index', ['recommendations' => $this->getRecommendations(), 'setting' => $settings->first()]);
    }

    public function recommendation_add(Settings $settings)
    {
        return view('admin.recommendations.add', ['setting' => $settings->first()]);
    }

    public function recommendation_add_process(LoanStoreRequest $loanStoreRequest)
    {
        return $this->storeRecommendation($loanStoreRequest) ? redirect()->route('admin.recommendation')->with('success', 'Berhasil menambahkan data rekomendasi pinjaman') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function recommendation_edit(Request $request, Settings $settings)
    {
        return view('admin.recommendations.add', ['recommendation' => $this->getRecommendation($request->id) , 'setting' => $settings->first()]);
    }

    public function recommendation_edit_process(LoanStoreRequest $loanStoreRequest)
    {
        return $this->updateRecommendation($loanStoreRequest) ? redirect()->route('admin.recommendation')->with('success', 'Berhasil mengubah data rekomendasi pinjaman') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function recommendation_delete(Request $request)
    {
        return $this->deleteRecommendation($request->id) ? back()->with('success', 'Berhasil menghapus data rekomendasi') : back()->withErrors('Data rekomendasi tidak ditemukan');
    }

    public function instalment_add(InstalmentRequest $instalmentRequest)
    {
        return $this->storeInstalment($instalmentRequest) ? back()->with('success', 'Berhasil menambahkan pembayaran') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function instalment_edit(InstalmentRequest $instalmentRequest)
    {
        return $this->updateInstalment($instalmentRequest) ? back()->with('success', 'Berhasil mengubah pembayaran') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function instalment_delete(Request $request)
    {
        return $this->deleteInstalment($request->id) ? back()->with('success', 'Berhasil menghapus pembayaran') : back()->withErrors('Data riwayat pembayaran tidak ditemukan');
    }

    public function setting_account()
    {
        return view('admin.setting-account');
    }

    public function setting_account_process(EditUserRequest $editUserRequest)
    {
        return $this->updateUser($editUserRequest) ? back()->with('success', 'Berhasil menyimpan pengaturan') : back()->withErrors('Terjadi kesalahan, silakan hubungi admin');
    }

    public function logout()
    {
        return auth('admin')->logout() ? redirect()->route('login') : back();
    }
}
