<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Api\Product\IndexRequest;
use App\Http\Requests\Api\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();

        $query = Product::query();

        if (isset($data['category_name'])) {
            $query->whereRelation('category', 'name', 'ilike', $data['category_name']);
        }

        $products = $query->with('category')->paginate(10);

        return ProductResource::collection($products)->response();
    }

    public function show(Product $id)
    {
        return ProductResource::make($id->load('category'))->response();

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        return ProductResource::make($product)->response()->setStatusCode(201);
    }

    public function update(StoreRequest $request, Product $id)
    {
        $data = $request->validated();
        $id->update($data);
        return ProductResource::make($id)->response()->setStatusCode(200);
    }

    public function destroy(Product $id)
    {
        $id->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], Response::HTTP_OK);
    }
}
