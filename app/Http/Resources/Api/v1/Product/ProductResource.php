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
            'category_id' => $this->category_id,
            'category_name' => $this->products->nome,
            'nome' => $this->nome,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'preco_original' =>$this->preco_original,
            'preco_atual' =>$this->preco_atual,
            'descricao' => $this->descricao,
            'destaque' => $this->destaque,
            'status' => $this->status,
            'images' => $this->whenLoaded('productImages'),
            'atributos' => $this->whenLoaded('attributes'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
