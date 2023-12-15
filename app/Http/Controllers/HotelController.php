<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\http\Requests\HotelRequest;
use Illuminate\Support\DB;
use App\Models\Prefectures;

class HotelController extends Controller
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
