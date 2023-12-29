<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $params = $request->query();

        $plans = Plan::latest()
            ->with('reservations')
            ->MyPlan()
            ->searchStatus($params)
            ->paginate(5);

        return view('auth.company.dashboard', compact('plans'));
    }
}
