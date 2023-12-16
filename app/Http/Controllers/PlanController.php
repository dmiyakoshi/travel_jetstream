<?php

namespace App\Http\Controllers;

use App\Consts\CompanyConst;
use App\Consts\UserConst;
use App\Http\Requests\PlanRequest;
use App\Models\Hotel;
use App\Models\Plan;
use App\Models\PlanView;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::where('company_id', Auth::guard(CompanyConst::class)->user()->id);

        return view('plans.create', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $plan = new Plan($request->all());

        try {
            $plan->save();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('登録処理でエラーが発生しました');
        }

        return redirect()->route('plan.show', $plan)->with('notice', '登録処理が成功しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        if (Auth::guard(UserConst::class)->check()) {
            PlanView::updateOrCreate([
                'plan_id' => $plan->id,
                'user_id' => Auth::guard(UserConst::class)->user()->id,
            ]);
        }

        return view('plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
