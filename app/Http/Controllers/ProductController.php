<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $data=Product::all();
        return response($data);
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Product::create($data);
    }

}
