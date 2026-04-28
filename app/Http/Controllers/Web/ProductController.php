<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $products = ProductResource::collection(Product::with('category')->paginate(10));
//        return inertia('Product/Index', [
//            'products' => $products
//        ]);
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = ProductResource::collection(Product::with('category')->paginate(10)->withQueryString());

        return inertia('Product/Index', [
                'products' => $products,
                'categories' => Category::all(),
                'filters' => $request->only('category_id'),
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {

        $id = ProductResource::make($id->load('category'))->resolve();
        return inertia('Product/Show', [
            'product' => $id
        ]);
    }
}
