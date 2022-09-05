<?php

namespace App\Http\Controllers;

use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Auth;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = AdminProfile::get();
        return view('penjual.profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $profile = new AdminProfile([
            'user_id' => Auth::user()->id,
            'year' => $request['year'],
            'address' => $request['address'],
            'description' => $request['description'],
            'bank' => $request['bank'],
            'bank_account' => $request['bank_account'],
        ]);
        $profile->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminProfile  $adminProfile
     * @return \Illuminate\Http\Response
     */
    public function show(AdminProfile $adminProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminProfile  $adminProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminProfile $adminProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminProfile  $adminProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminProfile $adminProfile)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $adminProfile->year = $request['year'];
        $adminProfile->address = $request['address'];
        $adminProfile->description = $request['description'];
        $adminProfile->bank = $request['bank'];
        $adminProfile->bank_account = $request['bank_account'];
        $adminProfile->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminProfile  $adminProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminProfile $adminProfile)
    {
        //
    }
}
