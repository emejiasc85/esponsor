<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Guest\ProductResourse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $categories = Product::query()
            ->search()
            ->with(['file', 'category'])
            ->paginateIf();
        return ProductResourse::collection($categories);
    }
}
