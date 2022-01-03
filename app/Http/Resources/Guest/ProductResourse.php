<?php

namespace App\Http\Resources\Guest;

use App\Http\Resources\Admin\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResourse extends JsonResource
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
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'stock'       => $this->stock,
            'min_price'   => $this->min_price,
            'file'        => new FileResource($this->whenLoaded('file')),
            'category'    => new CategoryResourse($this->whenLoaded('category')),
        ];
    }
}
