<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = Dish::all();

        if ($request->image) {
            foreach($dishes as $dish) {
                $dish["data_img"] = DishController::image64($dish->code);
            }
        }

        return response()->json($dishes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* 
    {
        "name": "",
        "price": 0,
        "img_url": ""
    }
    */
    public function store(Request $request)
    {
        $dish = $request->dish;
        $products = $request->products;
        $dish = Dish::create($dish);

        // Add products
        foreach ($products as $product) {
            $dish->products()->attach($product);
        }   
        
        return response()->json([
            'dish' => $dish,
            'url' => "/api/dishes/{$dish->id}"
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
        return response()->json(Dish::find($id));
    }

    public function showProducts($id)
    {
        $dish = Dish::find($id);
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
        $dish = Dish::find($id);
        $dish->update($data);
        
        return response()->json($dish, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->delete();
        return response()->json([
            'message' => 'Succesfully Deleted',
            'url' => '/api/dishes'
        ]);
    }

    public function image64($name) {
        $path = storage_path('app/public/'.$name.".png");

        if(File::Exists($path)) {
            $file = File::get($path);
        }
        else 
        {
            $path = storage_path('app/public/not-found.png');
            $file = File::get($path);
        }

        $imgData = file_get_contents($path, true);

        //dump(base64_encode($imgData));

        return base64_encode($imgData);
    }
}
