<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use App\Consts\CompanyConst;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reservation $reservation): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Plan $plan): bool
    {
        return Auth::guard(UserConst::GUARD)->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reservation $reservation): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reservation $reservation, Plan $plan): bool
    {
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reservation $reservation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reservation $reservation): bool
    {
        //
    }
}
