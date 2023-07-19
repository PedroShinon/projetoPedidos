<?php

namespace App\Http\Resources\Api\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'categoria' => $this->categoria,
            'marca' => $this->marca,
            'nome' => $this->nome,
            'modelo' => $this->modelo,
            'preco_original' =>$this->preco_original,
            'preco_atual' =>$this->preco_atual,
            'destaque' => $this->destaque,
            'status' => $this->status,
            'images' => $this->whenLoaded('productImages'),
            'atributos' => $this->whenLoaded('attributes'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
