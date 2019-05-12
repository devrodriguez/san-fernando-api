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
        $orders = Order::all();
        return response()->json($orders);
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
        $products = $request->products;
        $dishesId = $request->dishes;
        $dishes = Dish::find($dishesId);

        $allProducts = [];

        //Insert order
        $order->price = $request->price;
        $order->payment_method = $request->payment_method;
        $order->carrier = $request->carrier;
        $order->save();
        
        foreach($dishes as $dish)
        {
            // Add dishes
            $order->dishes()->attach($dish->id);
        }

        foreach($products as $product)
        {            
            // Add products
            $order->products()->attach($product);
        }

        return response()->json([
            'order' => $order,
            'url' => "/api/orders/{$order->id}"
        ]);
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
