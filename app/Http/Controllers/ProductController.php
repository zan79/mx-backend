<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function show(Product $product) {
        return response()->json($product,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $products = Product::where('name','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($products, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'brand' => 'string|required',
            'description' => 'string|required',
            'price' => 'numeric|required',
            'stock' => 'numeric|required',
        ]);

        try {
            $product = Product::create($request->all());
            return response()->json($product, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Product $product) {
        try {
            $product->update($request->all());
            return response()->json($product, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->json(['message'=>'Product deleted.'],202);
    }

    public function index() {
        $products = Product::orderBy('name')->get();
        return response()->json($products, 200);
    }
}
