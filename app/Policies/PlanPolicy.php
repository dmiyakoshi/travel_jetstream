<?php

namespace App\Policies;

use App\Consts\CompanyConst;
use App\Models\Plan;
use App\Models\Company;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PlanPolicy
{
    /**
     * Determine whether the Company can view any models.
     */
    public function viewAny(Company $company): bool
    {
        //
    }

    /**
     * Determine whether the Company can view the model.
     */
    public function view(Company $company, Plan $plan): bool
    {
        //
    }

    /**
     * Determine whether the Company can create models.
     */
    public function create(Company $company): bool
    {
        
    }

    /**
     * Determine whether the Company can update the model.
     */
    public function update(Company $company, Plan $plan): bool
    {
        return Auth::guard(CompanyConst::GUARD)->user()->id == $plan->hotel()->company_id; 
    }

    /**
     * Determine whether the Company can delete the model.
     */
    public function delete(Company $company, Plan $plan): bool
    {
        return Auth::guard(CompanyConst::GUARD)->user()->id === $plan->hotel()->company_id; 
    }

    /**
     * Determine whether the Company can restore the model.
     */
    public function restore(Company $company, Plan $plan): bool
    {
        //
    }

    /**
     * Determine whether the Company can permanently delete the model.
     */
    public function forceDelete(Company $company, Plan $plan): bool
    {
        //
    }
}
