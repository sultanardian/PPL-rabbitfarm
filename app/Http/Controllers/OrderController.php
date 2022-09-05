<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\AdminProfile;
use App\Models\BuyerProfile;
use DB;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = BuyerProfile::where('user_id', Auth::user()->id)->get();
        if (empty($profile[0])) {
            $profile = False;
        }
        else{
            $profile = True;
        }

        return view('pembeli.pesanan.index', compact('profile'));
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
        $order = new Order([
            'title' => $request->title,
            'description' => $request->description,
            'weight' => $request->weight,
            'confirmed_offer' => 'no'
        ]);
        Auth::user()->orders()->save($order);

        // $last = DB::table('orders')->orderBy('created_at', 'DESC')->first();
        // return $last;

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $offers = DB::table('stocks')
                ->where('offers.order_id', '=', $order->id)
                ->join('offers', 'stocks.id', '=', 'offers.stock_id')
                ->select('offers.id as offer_id', 'stocks.id as stock_id', 'stock', 'total_stock', 'price', 'date', 'confirmed_payment', 'img')
                ->get();

        $payments = DB::table('payments')
                    ->where('offers.order_id', '=', $order->id)
                    ->join('offers', 'payments.offer_id', '=', 'offers.id')
                    ->get();

        if (isset($payments[0])) {
            $payments = True;
        }
        else{
            $payments = False;
        }

        $admin_profile = AdminProfile::get();
        $buyer_profile = BuyerProfile::where('user_id', Auth::user()->id)->get();
        
        return view('pembeli.pesanan.show', compact('order', 'offers', 'payments', 'admin_profile', 'buyer_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('pembeli.pesanan.update', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'title' => $request->title,
            'description' => $request->description,
            'weight' => $request->weight,
        ]);
        return redirect()->route('order.show', $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('home');
    }
}
