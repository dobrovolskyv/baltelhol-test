<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductResource::collection(Product::with('category')->paginate(10));
        return inertia('Admin/Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Product/Create', [
        'categories' => CategoryResource::collection(Category::all())  ,
        'product' => new ProductResource(Product::all())
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductResource $request)
    {
        Product::create($request->validated());
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return inertia('Admin/Product/Edit', [
            'product' => $product,
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductResource $request, Product $product)
    {
        $data= $request->validated();
        $product->update($data);
        return redirect()->reoute('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
