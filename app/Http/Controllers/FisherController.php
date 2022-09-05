<?php

namespace App\Http\Controllers;

use App\Models\Fisher;
use Illuminate\Http\Request;
use DB;

class FisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $fishers = Fisher::get();

        $stocks = DB::table('fishers')
                ->leftJoin('stocks', 'fishers.id', '=', 'stocks.fisher_id')
                ->select('fisher_id as id', 'stock', 'total_stock', 'price', 'date')
                ->get();
        // return $fishers;
        return view('penjual.nelayan.index', compact('fishers', 'stocks'));
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
        $fisher = new Fisher([
            'fisher_name' => $request->fisher_name,
            'fisher_address' => $request->fisher_address,
        ]);
        $fisher->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fisher  $fisher
     * @return \Illuminate\Http\Response
     */
    public function show(Fisher $fisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fisher  $fisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Fisher $fisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fisher  $fisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fisher $fisher)
    {
        $fisher->fisher_name = $request->fisher_name;
        $fisher->fisher_address = $request->fisher_address;
        $fisher->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fisher  $fisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fisher $fisher)
    {
        $fisher->delete();
        return redirect()->back();
    }
}
