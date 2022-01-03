<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::query()
            ->where('user_id', auth()->id())
            ->with(['user', 'products.product'])
            ->paginateIf();

        return CartResource::collection($carts);
    }

    public function store(Request $request)
    {

        $cart = Cart::create([
            'user_id' => auth()->id()
        ]);

        $cart->addProducts();
        $cart->setTotal();

        return new CartResource($cart);
    }
}