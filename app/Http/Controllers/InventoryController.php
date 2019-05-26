<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = DB::table('inventories_detail')
        ->join('products', 'inventories_detail.product_id', '=', 'products.id')
        ->join('inventories', 'inventories_detail.inventory_id', '=', 'inventories.id')
        ->get();
        
        return response()->json($inventory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory = new Inventory;
        $inventory->save();
        
        //dd($request->all());

        foreach($request->all() as $input)
        {
            //dd($input['available_amount']);

            $inventory->products()->attach($input['product_id'], [
                'inventory_id' => $inventory->id,
                'available_amount' => $input['available_amount']
            ]);
        }

        return response()->json([
            'message' => 'Inventory stored'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $inventory = Inventory::whereDate('created_at', '=', $date)->get();

        return response()->json($inventory);
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
