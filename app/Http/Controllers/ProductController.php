<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = ProductResource::collection(Product::with('category')->paginate(7));
        return inertia('Product/Index', [
            'products' => $product
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {

        $id= ProductResource::make($id->load('category'))->response()->setStatusCode(200)->response();
        return inertia('Product/Show', [
            'product' => $id
        ]);
    }
}
