<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Product\ProductQuery;


class ProductService {

    public function getAll($request)
    {
        $filter = new ProductQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $products = Product::all();
            return $products;
        } else {
            $products = Product::where($queryItems)->get();
            return $products;
        }
    }

    public function create($request)
    {
        $category = Category::find($request->category_id);
        if (!$category) {
            return false;
        }
        $product = $category->products()->create([
            'category_id' => $request->category_id,
            'nome' => $request->nome,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'descricao' => $request->descricao,
            'preco_atual' => $request->preco_atual,
            'destaque' => $request->destaque ?? false,
            'status' => $request->status ?? false,
        ]);

        return $product;
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function update($request, $id)
    {
      $product = Product::find($id);
      if($product){
        $product->update([
            'nome' => $request->nome ?? $product->nome,
            'marca' => $request->marca ?? $product->marca,
            'modelo' => $request->modelo ?? $product->modelo,
            'descricao' => $request->descricao ?? $product->descricao,
            'preco_atual' => $request->preco_atual ?? $product->preco_atual,
            'destaque' => $request->destaque ?? $product->destaque,
            'status' => $request->status ?? $product->status,
        ]);
        return $product;
      }
      return false;
    }

    public function delete($id): void
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}