<?php

namespace App\Http\Resources\Api\v1\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\v1\Product\ProductResource;
use App\Http\Resources\Api\v1\ProductAttribute\ProductAttributeResource;


class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'produto' => ProductResource::make($this->whenLoaded('produto')),
            
            'attribute_id' => $this->attribute_id,
            'atributo' => ProductAttributeResource::make($this->whenLoaded('prodAtributo')),

            'image' => $this->image,
            'attributoName' => $this->attributoName,
            'quantidade' => $this->quantidade,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
