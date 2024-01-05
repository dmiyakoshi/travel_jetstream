<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $hotels = Hotel::where('company_id', Auth::guard('companies')->user()->id);

        return view('auth.company.dashboard', compact('plans', 'hotels'));
    }
}
