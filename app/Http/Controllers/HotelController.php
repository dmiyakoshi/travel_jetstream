<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\http\Requests\HotelRequest;
use Illuminate\Support\DB;
use App\Models\Prefectures;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('companies')->check()) {
            $hotel = Hotel::where('companies');
        }

        // どうするか未定
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prefectures = Prefectures::all();

        return view('hotels.create', compact('prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        $hotel = new Hotel($request->all());
        $hotel->company_id = $request->user()->id;


        try {
            $hotel->save();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('登録処理でエラーが発生しました');
        }

        return redirect()
        ->route('hotels.show', $hotel)
        ->with('notice', '情報登録に成功しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $prefecture = Prefectures::where('prefecture_id', $hotel->prefecture_id);

        $plan = $hotel->plans()->latest();
        return view('hotels.show', compact('hotel', 'plans', 'prefecture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, Hotel $hotel)
    {
        if (Auth::guard('companies')->user()->id == $hotel->company_id) {
            return redirect()->route('hotels.show', $hotel)->withErrors('errors', '編集権限がありません');
        }

        $hotel->fill($request->all());

        try {
            $hotel->save();
        } catch (\Throwable $th) {
            redirect()->route('hotels.show', $hotel)->withErrors('errors', '編集保存時にエラーが発生しました。');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        if (Auth::guard('companies')->user()->id == $hotel->company_id) {
            return redirect()->route('hotels.show', $hotel)->withErrors('errors', '削除権限がありません');
        }

        try {
            $hotel->delete();
        } catch (\Throwable $th) {
            redirect()->route('hotels.show', $hotel)->withErrors('errors', '削除の際にエラーが発生しました。');
        }
    }
}
