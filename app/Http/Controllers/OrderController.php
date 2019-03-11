<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Dish;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $order = new Order;
        $productsId = $request->products;
        $dishesId = $request->dishes;
        $dishes = Dish::find($dishesId);
        $products = Product::find($productsId);

        $allProducts = [];

        //Insert order
        $order->price = $request->price;
        $order->save();

        
        foreach($dishes as $dish)
        {
            foreach($dish->products as $product)
            {
                array_push($allProducts, $product);
            }

            // Add dishes
            $order->dishes()->attach($dish->id);
        }

        foreach($products as $product)
        {
            array_push($allProducts, $product);
            $order->products()->attach($product->id);
        }
        
        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return response()->json($order);
    }
  
    public function showDishes($id) {
        $order = Order::find($id);
        $dishes = $order->dishes;

        return response()->json($dishes);
    }

    public function showProducts($id) {
        $dish = Order::find($id);
        $products = $dish->products;

        return response()->json($products);
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
        $data = $request->all();
        $order = Order::find($id);
        $order->update($data);

        return response()->json($order, 200);
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
