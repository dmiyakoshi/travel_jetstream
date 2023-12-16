<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\Company;
use Illuminate\Auth\Access\Response;

class PlanPolicy
{
    /**
     * Determine whether the Company can view any models.
     */
    public function viewAny(Company $Company): bool
    {
        //
    }

    /**
     * Determine whether the Company can view the model.
     */
    public function view(Company $Company, Plan $plan): bool
    {
        //
    }

    /**
     * Determine whether the Company can create models.
     */
    public function create(Company $Company): bool
    {
        //
    }

    /**
     * Determine whether the Company can update the model.
     */
    public function update(Company $Company, Plan $plan): bool
    {
        return $Company->id === $plan->hotel()->company_id; 
    }

    /**
     * Determine whether the Company can delete the model.
     */
    public function delete(Company $Company, Plan $plan): bool
    {
        return $Company->id === $plan->hotel()->company_id; 
    }

    /**
     * Determine whether the Company can restore the model.
     */
    public function restore(Company $Company, Plan $plan): bool
    {
        //
    }

    /**
     * Determine whether the Company can permanently delete the model.
     */
    public function forceDelete(Company $Company, Plan $plan): bool
    {
        //
    }
}
