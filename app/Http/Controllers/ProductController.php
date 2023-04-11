<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function createData(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

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
        $validator = Validator::make($request->all(),[
            'product_name' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        Product::findOrFail($id)->update([
            'name' => $request -> product_name,
            'price' => $request -> price,
            'desc' => $request -> desc
        ]);

        return response()->json([
            'message' =>  'success update data'
        ]);
    }

    public function deleteData($id) //This function is a part of a PHP web application and deletes a record from the "Product" table of a database based on the ID of the product passed as a parameter.

    {
        Product::destroy($id); // The function receives an ID of the product to be deleted as a parameter "$id". The function then uses the Eloquent ORM (Object-Relational Mapping) to find and delete the record with that ID from the "Product" table. The Product::destroy() method deletes the record using the primary key of the product.
        return response()->json([
            'message' => 'success delete data'
        ]);
    }


// Finally, the function returns a JSON response indicating that the data was successfully deleted.
}
