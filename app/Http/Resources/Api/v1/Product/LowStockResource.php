<?php

namespace App\Http\Resources\Api\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LowStockResource extends JsonResource
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
            'nomeDoProduto' => $this->product->nome,
            'nomeDoAtributo' => $this->nome,
            'product_id' => $this->product_id,
            'quantidade' => $this->quantidade,
            

        ];
    }
}
