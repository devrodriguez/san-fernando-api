<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Inventory;
use App\Product;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $stock = DB::table('inventories_detail')
        ->join('products', 'inventories_detail.product_id', '=', 'products.id')
        ->join('inventories', 'inventories_detail.inventory_id', '=', 'inventories.id')
        ->get();
        */
        $stock = Product::all();
        return response()->json($stock);
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

        foreach($request->all() as $input)
        {
            $inventory->products()->attach($input['id'], [
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

    public function approve() {
        $inventory = DB::table('inventories_detail')
        ->join('products', 'inventories_detail.product_id', '=', 'products.id')
        ->where('inventory_id', DB::raw("(select max(inventory_id) from inventories_detail where date_format(created_at, '%M/d%/%Y') = date_format(now(), '%M/d%/%Y'))"))
        ->select(['inventories_detail.inventory_id', 'products.id as product_id', 'inventories_detail.available_amount'])
        ->get();

        foreach($inventory as $item) 
        {
            $product = Product::find($item->product_id);
            $product->available_amount = $item->available_amount;
            $product->save();
        }

        return response()->json([
            'message' => 'Updated'
        ]);
    }

    public function last() {
        $inventory = DB::table('inventories_detail')
        ->join('products', 'inventories_detail.product_id', '=', 'products.id')
        ->where('inventory_id', DB::raw("(select max(inventory_id) from inventories_detail where date_format(created_at, '%M/d%/%Y') = date_format(now(), '%M/d%/%Y'))"))
        ->select(['inventories_detail.inventory_id', 'products.id as product_id', 'inventories_detail.available_amount'])
        ->get();

        return response()->json($inventory);
    }
}
