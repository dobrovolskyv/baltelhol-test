<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function index()
    {
        return CategoryResource::collection(Category::all())->response()->setStatusCode(200);
    }

    public function show()
    {

    }

    public function store()
    {

    }
    public function update()
    {

    }

    public function destroy()
    {
        
    }
}
