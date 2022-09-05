<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use DB;

class ConfirmedOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = DB::table('offers')
                            ->where('orders.confirmed_offer', '=', 'yes')
                            ->join('stocks', 'offers.stock_id', '=', 'stocks.id')
                            ->join('fishers', 'stocks.fisher_id', '=', 'fishers.id')
                            ->join('orders', 'offers.order_id', '=', 'orders.id')
                            ->join('users', 'orders.user_id', '=', 'users.id')
                            ->join('buyer_profiles', 'users.id', '=', 'buyer_profiles.user_id')
                            ->select('offers.id AS offer_id', 'name', 'title', 'weight', 'stock', 'total_stock', 'price', 'confirmed_payment', 'fisher_name')
                            ->get();

        // return $confirmed_offers;

        return view('penjual.pengajuan.confirmed.index', compact('offers'));
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
    public function show(Request $request, $id)
    {
        if ($request['payment'] == 'no') {
            $offers = DB::table('offers')
                    ->where('offers.id', '=', $id)
                    ->join('stocks', 'offers.stock_id', '=', 'stocks.id')
                    ->join('orders', 'offers.order_id', '=', 'orders.id')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('buyer_profiles', 'users.id', '=', 'buyer_profiles.user_id')
                    ->get();
        }
        else{
            $offers = DB::table('offers')
                    ->where('offers.id', '=', $id)
                    ->join('payments', 'payments.offer_id', '=', 'offers.id')
                    ->join('stocks', 'offers.stock_id', '=', 'stocks.id')
                    ->join('orders', 'offers.order_id', '=', 'orders.id')
                    ->join('users', 'orders.user_id', '=', 'users.id')
                    ->join('buyer_profiles', 'users.id', '=', 'buyer_profiles.user_id')
                    ->get();

            $feedback = Feedback::where('offer_id', $id)->get();
            return view('penjual.pengajuan.confirmed.show', compact('offers', 'feedback'));
        }
        // return $offers;
        return view('penjual.pengajuan.confirmed.show', compact('offers'));
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
