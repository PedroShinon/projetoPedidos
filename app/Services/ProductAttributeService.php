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
        if($request->atributos){
            //dd($request->atributos);
            //$request->atributos = json_decode($request->atributos);
            //dd($request->atributos);
            
            foreach($request->atributos as $atributo){
                //dd($atributo->quantidade);
                //dd($atributo);
                $atributo = json_decode($atributo);
               
                $product->attributes()->create([
                    'product_id' => $product->id,
                    //'attribute_id' => $atributo,
                    //'attribute_value_id' => $request->atributo_value_id[$key],
                    //'valor' => $request->atributoValor[$key],
                    'nome' => $atributo->nome ?? "cor preta",
                    'quantidade' => $atributo->quantidade ?? 0
                ]);
            }
            return $producter = Product::with('productImages', 'attributes')->where('id', $product->id)->first();
                
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