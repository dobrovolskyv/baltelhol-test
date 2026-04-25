<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductResource::collection(Product::with('category')->paginate(10));
        return inertia('Product/Index', [
            'products' => $products
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {

        $id= ProductResource::make($id->load('category'))->resolve();
        return inertia('Product/Show', [
            'product' => $id
        ]);
    }
}
