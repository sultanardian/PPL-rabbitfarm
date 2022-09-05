<?php

namespace App\Http\Controllers;

use App\Models\BuyerProfile;
use Illuminate\Http\Request;
use Auth;

class BuyerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = BuyerProfile::where('user_id', Auth::user()->id)->get();
        
        return view('pembeli.profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        // return $user;
        $profile = new BuyerProfile([
            'user_id' => Auth::user()->id,
            'owner' => $request['owner'],
            'year' => $request['year'],
            'address' => $request['address'],
            'description' => $request['description'],
        ]);
        $profile->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuyerProfile  $buyerProfile
     * @return \Illuminate\Http\Response
     */
    public function show(BuyerProfile $buyerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuyerProfile  $buyerProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(BuyerProfile $buyerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuyerProfile  $buyerProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuyerProfile $buyerProfile)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $buyerProfile->owner = $request['owner'];
        $buyerProfile->year = $request['year'];
        $buyerProfile->address = $request['address'];
        $buyerProfile->description = $request['description'];
        $buyerProfile->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuyerProfile  $buyerProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyerProfile $buyerProfile)
    {
        //
    }
}
