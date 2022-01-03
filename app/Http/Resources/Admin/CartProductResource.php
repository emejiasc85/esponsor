<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Guest\ProductResourse;
use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'real_price' => $this->real_price,
            'total'      => $this->total,
            'product'    => new ProductResourse($this->whenLoaded('product')),
        ];
    }
}
