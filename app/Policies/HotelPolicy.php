<?php

namespace App\Policies;

use App\Consts\CompanyConst;
use App\Models\Hotel;
use App\Models\Company;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class HotelPolicy
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
    public function view(Company $company, Hotel $hotel): bool
    {
        //
    }

    /**
     * Determine whether the Company can create models.
     */
    public function create(Company $company): bool
    {
        return Auth::guard('companies')->check();
    }

    /**
     * Determine whether the Company can update the model.
     */
    public function update(Company $company, Hotel $hotel): bool
    {
        return Auth::guard('companies')->user()->id == $hotel->company_id; 

    }

    /**
     * Determine whether the Company can delete the model.
     */
    public function delete(Company $company, Hotel $hotel): bool
    {
        return Auth::guard('companies')->user()->id == $hotel->company_id; 
    }

    /**
     * Determine whether the Company can restore the model.
     */
    public function restore(Company $company, Hotel $hotel): bool
    {
        //
    }

    /**
     * Determine whether the Company can permanently delete the model.
     */
    public function forceDelete(Company $company, Hotel $hotel): bool
    {
        //
    }
}
