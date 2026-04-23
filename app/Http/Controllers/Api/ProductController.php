<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return ProductResource::collection($product->load('category'))->response()->setStatusCode(200);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        return ProductResource::make($product)->response()->setStatusCode(201);
    }
    public function update(StoreRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);
        return ProductResource::make($product)->response()->setStatusCode(200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
