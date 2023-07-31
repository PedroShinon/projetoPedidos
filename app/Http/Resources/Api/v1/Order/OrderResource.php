<?php

namespace App\Http\Resources\Api\v1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//'atributo' => ProductAttributeResource::make($this->whenLoaded('prodAtributo')),

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
