<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\AdminProfile;
use App\Models\Fisher;
use DB;
use Storage;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = AdminProfile::get();

        if (empty($profile[0])) {
            $profile = False;
        }
        else{
            $profile = True;
        }

        // $datas = Stock::with('fishers')->get();
        $datas = DB::table('stocks')
                ->join('fishers', 'stocks.fisher_id', '=', 'fishers.id')
                ->select('stock', 'fisher_name', 'total_stock', 'price', 'date', 'stocks.id as id', 'img')
                ->get();
                // return $datas;
        return view('penjual.stok.index', compact('datas', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fishers = Fisher::get();
        return view('penjual.stok.create', compact('fishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->image->getClientOriginalName();
        $stock = new Stock([
            'fisher_id' => $request->fisher_id,
            'stock' => $request->stock,
            'total_stock' => $request->total_stock,
            'price' => $request->price,
            'date' => $request->date,
            'img' => $request->image->getClientOriginalName()
        ]);
        $stock->save();

        Storage::disk('public')->putFileAs('img/product', $request->image, $request->image->getClientOriginalName());

        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('penjual.stok.update', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        if (is_null($request->image)) {
            $img = $request->old_image;
        }
        else {
            $img = $request->image->getClientOriginalName();

            Storage::disk('public')->putFileAs('img/product', $request->image, $img);
        }

        $stock->update([
            'stock' => $stock->stock,
            'total_stock' => $request->total_stock,
            'price' => $request->price,
            'date' => $request->date,
            'img' => $img
        ]);

        return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->back();
    }
}
