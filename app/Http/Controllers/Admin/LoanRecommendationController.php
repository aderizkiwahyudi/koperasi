<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\LoanRecommendations;
use Illuminate\Http\Request;

class LoanRecommendationController extends AdminController
{
    protected $loan_recommendation;
    public function __construct()
    {
        $this->loan_recommendation = new LoanRecommendations();
    }

    protected function getRecommendations()
    {
        return $this->loan_recommendation->latest()->get();
    }

    protected function getRecommendation($id)
    {
        return $this->loan_recommendation->where('id', $id)->firstOrFail();
    }

    protected function storeRecommendation($request)
    {
        return $this->loan_recommendation->create($request->validated());
    }

    protected function updateRecommendation($request)
    {
        return $this->loan_recommendation->find($request->id)->update($request->validated());
    }

    protected function deleteRecommendation($id)
    {
        return $this->loan_recommendation->where('id', $id)->delete();
    }
}
