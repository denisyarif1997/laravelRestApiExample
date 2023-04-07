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

    public function getAllData()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

    public function getData()
    {
        $product = Product::all();
        return response()->json([
        'products' => $product]);
    }

    public function searchData(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%'.$request->product_name.'%')->get();
        return response()->json([
            'productSearch' => $products
        ]);
    }

    public function updateData(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            'name' => $request -> product_name,
            'price' => $request -> price,
            'desc' => $request -> desc
        ]);

        return response()->json([
            'message' =>  'success update data'
        ]);
    }

    public function deleteData($id)
    {
        Product::destroy($id);
        return response()->json([
            'message' => 'success delete data'
        ]);
    }
}
