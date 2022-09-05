<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use Auth;
use DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->join('buyer_profiles', 'users.id', '=', 'buyer_profiles.user_id')
                ->where('confirmed_offer', '=', 'no')
                ->select('name', 'orders.id', 'title', 'orders.description', 'weight')
                ->get();
        // return $datas;
        return view('home', compact('datas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                ->join('buyer_profiles', 'users.id', '=', 'buyer_profiles.user_id')
                ->where('orders.id', '=', $id)
                ->select('name', 'address', 'orders.id AS order_id', 'title', 'orders.description AS description', 'weight')
                ->get();

        $stocks = DB::table('stocks')
                ->join('fishers', 'stocks.fisher_id', '=', 'fishers.id')
                ->select('stocks.id as stock_id', 'stock', 'fisher_name', 'total_stock', 'price', 'date', 'img')
                ->get();
        // return $stocks;
        // return $data;
        return view('penjual.pengajuan.index', compact('data', 'stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
