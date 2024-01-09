<?php

namespace App\Http\Controllers;

use App\Consts\CompanyConst;
use App\Consts\UserConst;
use App\Http\Requests\PlanRequest;
use App\Models\Hotel;
use App\Models\Plan;
use App\Models\PlanView;
use App\Models\Prefectures;
use App\Models\Region;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = '';
        foreach (config('fortify.users') as $guard) {
            if (Auth::guard(Str::plural($guard))->check()) {
                $user = Auth::guard(Str::plural($guard))->user();
            }
        }

        $regions = Region::all();

        $params = $request->query();
        $plans = Plan::search($params)->openData()
            ->order($params)->with(['hotel'])->latest()->paginate(5);
        $prefecture = $request->prefecture;
        $search = empty($prefecture) ? [] : ['prefecture' => $prefecture];
        $sort = empty($request->sort) ? [] : ['sort' => $request->sort];

        $plans->appends(compact('prefecture'));

        return view('plans.index', compact('plans', 'regions', 'sort', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::where('company_id', Auth::guard('campaines')->user()->id);

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
        if (Auth::guard('users')->check()) {
            PlanView::updateOrCreate([
                'plan_id' => $plan->id,
                'user_id' => Auth::guard('users')->user()->id,
            ]);
        }

        $reservation = $plan->reservation()->where('user_id', Auth::guard('users')->user()->id)->first();

        return view('plan.show', compact('plan', 'reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $hotel = Hotel::where('hotel_id', $plan->hotel_id);

        return view('plans.edit', compact('plan', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        if (Auth::guard('campaines')->user()->cannot('update', $plan)) {
            return redirect()->route('plans.show', $plan)
                ->withErrors('自分の求人情報以外は更新できません');
        }

        $plan->fill($request->all());

        try {
            $plan->save();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('求人情報更新処理でエラーが発生しました');
        }

        return redirect()->route('plans.show', $plan)
            ->with('notice', '求人情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        if (Auth::guard('campaines')->user()->cannot('delete', $plan)) {
            return redirect()->route('plans.show', $plan)
                ->withErrors('自分の求人情報以外は削除できません');
        }

        try {
            $plan->delete();
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors('求人情報削除処理でエラーが発生しました');
        }
        return redirect()->route('plans.index')
            ->with('notice', '求人情報を削除しました');
    }
}
