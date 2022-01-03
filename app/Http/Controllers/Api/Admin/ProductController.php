<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\Admin\ProductResourse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()
            ->where('user_id', auth()->id())
            ->search()
            ->with(['category', 'file', 'user'])
            ->paginateIf();

        return ProductResourse::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $product = Product::create($request->only([
            'title',
            'description',
            'stock',
            'min_price',
            'user_id',
            'category_id'
        ]));

        $product->addFile();

        return new ProductResourse($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        
        
        $product->update($request->only([
            'title',
            'description',
            'stock',
            'min_price',
            'category_id'
        ]));

        $product->addFile();

        return new ProductResourse($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([],204);
    }
}
