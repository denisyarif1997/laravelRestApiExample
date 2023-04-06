<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createData(Request $request)
    {
        Product::create([
            'name' => $request->product_name,
            'price' => $request->price,
            'desc' => $request->desc
        ]);
        return response()->json([
            'message' => 'success create data'
        ]);
    }

    public function getData()
    {
        $product = Product::all();
        return response()->json($product);
    }
}
