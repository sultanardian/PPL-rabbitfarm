<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->vendor == 1) {
            $datas = Auth::user()->orders()->orderBy('orders.id', 'DESC')->get();
            return view('home', compact('datas'));
        }
        elseif (Auth::user()->vendor == 2){
            // return redirect()->route('seller.index');
            $datas = DB::table('users')
                ->where('orders.confirmed_offer', '=', 'no')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->select('name', 'orders.id', 'title', 'description', 'weight')
                ->get();
            return view('home', compact('datas'));
        }
        else{
            return view('home');
        }
    }
}
