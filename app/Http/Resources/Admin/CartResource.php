<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'total'      => $this->total,
            'user'       => new UserResource($this->whenLoaded('user')),
            'products'   => CartProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
