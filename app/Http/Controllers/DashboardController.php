<?php

namespace App\Http\Controllers;

use App\Models\LoanRecommendations;
use App\Models\Settings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(LoanRecommendations $loanRecommendations, Settings $settings)
    {
        return view('dashboard.index', ['loan_recommendations' => $loanRecommendations->latest()->get(), 'setting' => $settings->first()]);
    }

    public function logout()
    {
        return auth('user')->logout() ? redirect(route('login')) : back();
    }
}
