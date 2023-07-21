<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Filter\v1\ProductAttribute\ProductAttributeQuery;
use Illuminate\Support\Facades\File;


class ProductAttributeService {

    public function getAll($request)
    {
        $filter = new ProductAttributeQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $atributo = ProductAttribute::all();
            return $atributo;
        } else {
            $atributo = ProductAttribute::where($queryItems)->get();
            return $atributo;
        }
    }

    public function getById($id)
    {
        return ProductAttribute::find($id);
    }

    public function create($request)
    {
        $product = Product::find($request->id);
        if($request->nome && $request->quantidade){
            $i = 0;
            foreach($request->nome as $key => $atributo){
                //dd($request->atributoValor[$key]);
                $product->attributes()->create([
                    'product_id' => $product->id,
                    //'attribute_id' => $atributo,
                    //'attribute_value_id' => $request->atributo_value_id[$key],
                    //'valor' => $request->atributoValor[$key],
                    'nome' => $request->nome[$key] ?? "preto",
                    'quantidade' => $request->quantidade[$key] ?? 0
                ]);
                $i++;
            }
            return " ". $i ." atributos adicionados";
                
        }
        return false;
        
    }


    public function update($request, $id)
    {
      $atributo = ProductAttribute::find($id);
      
      if($atributo){
    
        $atributo->nome = $request->nome ?? $atributo->nome;
        $atributo->quantidade = $request->quantidade ?? $atributo->quantidade;
        $atributo->save();
        return $atributo;
      }
      return false;
    }

    public function deleteAtributo($id): void
    {
        if ($atributo = ProductAttribute::where('id', $id)->first()) {
           $atributo->delete();
        }
        
    }
}