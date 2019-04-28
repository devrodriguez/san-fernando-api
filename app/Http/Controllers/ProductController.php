<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Product;
use App\Util\Images;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();

        if ($request->image) {
            foreach($products as $product) {
                $product["data_img"] = ProductController::image64($product->code);
            }
        }

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageContent = $request->image;
        $dataProduct = $request->all();
        $maxId = Product::max('id');
        $id = is_numeric($maxId) ? $maxId : 1;
        $code = 'SF'.str_pad($id, 4, '0', STR_PAD_LEFT);
        $imageName = $code.".png";

        $dataProduct["img_url"] = $imageName;
        $dataProduct['code'] = $code;

        $product = Product::create($dataProduct);
      
        if ($product != null) {
            Images::store_image($imageName, 'public', $imageContent);
        }

        return response()->json([
            'product' => $product,
            'url' => "/api/products/{$product->id}"
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
        $product = Product::findOrFail($id);
        $product['data_img'] = ProductController::image64($product->code);
        return response()->json($product);
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
        $imageName = $request->code.".png";
        $imageEncode = $request->image;
        $product = Product::find($id);

        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->img_url = $imageName;

        $updated = $product->save();

        if ($updated && $imageEncode != null) {
            Images::store_image($imageName, 'public', $imageEncode);
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'message' => 'Succesfully Deleted',
            'url' => '/api/dishes'
        ]);
    }

    public function image($name) {
        $path = storage_path('app/public/'.$name.".png");
        
        if(File::Exists($path)) {
            $file = File::get($path);
            $type = File::mimeType($path);
        }
        else 
        {
            $path = storage_path('app/public/not-found.jpg');
            $file = File::get($path);
            $type = File::mimeType($path);
        }

        return response($file, 200)->header("Content-Type", $type);
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
