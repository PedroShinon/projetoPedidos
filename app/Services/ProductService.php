<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Product\ProductQuery;
use Illuminate\Support\Facades\File;


class ProductService {

    protected $uploadPath = 'storage/products/';

    public function getAll($request)
    {
        $filter = new ProductQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $products = Product::with('productImages', 'attributes')->get();
            return $products;
        } else {
            $products = Product::with('productImages', 'attributes')->where($queryItems)->get();
            return $products;
        }
    }

    public function create($request)
    {
        $product = Product::create([
            'categoria' => $request->categoria,
            'user_id' => $request->user_id,
            'nome' => $request->nome,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'preco_original' => $request->preco_original,
            'preco_atual' => $request->preco_atual,
            'destaque' => $request->destaque ?? false,
            'status' => $request->status ?? false,
        ]);
        if($request->file('image')){    
            $uploadPath = 'storage/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                //dd($imageFile);
                //$imageFile = $request->file('image');
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                
                //verificar se existe directory
                if (!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0777, true, true);
                }
                //stocar file
                $imageFile->move($uploadPath, $filename);

                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        
        if($request->atributoNome && $request->atributoQuantidade){
            
            foreach($request->atributoNome as $key => $atributo){
                //dd($request->atributoValor[$key]);
                $product->attributes()->create([
                    'product_id' => $product->id,
                    //'attribute_id' => $atributo,
                    //'attribute_value_id' => $request->atributo_value_id[$key],
                    //'valor' => $request->atributoValor[$key],
                    'nome' => $request->atributoNome[$key] ?? "cor preta",
                    'quantidade' => $request->atributoQuantidade[$key] ?? 0
                ]);
            }
                
        }

        return $product;
    }

    public function getById($id)
    {
        return Product::with('productImages', 'attributes')->find($id);
    }

    public function update($request, $id)
    {
      $product = Product::find($id);
      if($product){
        $product->update([
            'nome' => $request->nome ?? $product->nome,
            'categoria' => $request->categoria ?? $product->categoria,
            'marca' => $request->marca ?? $product->marca,
            'modelo' => $request->modelo ?? $product->modelo,
            'preco_original' => $request->preco_original ?? $product->preco_original,
            'preco_atual' => $request->preco_atual ?? $product->preco_atual,
            'destaque' => $request->destaque ?? $product->destaque,
            'status' => $request->status ?? $product->status,
        ]);
        if($request->file('image')){
            $uploadPath = 'storage/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if($request->atributoNome && $request->atributoQuantidade){
            
            foreach($request->atributos as $key => $atributo){
                //dd($request->atributoValor[$key]);
                $product->attributes()->create([
                    'product_id' => $product->id,
                    //'attribute_id' => $atributo,
                    //'attribute_value_id' => $request->atributo_value_id[$key],
                    //'valor' => $request->atributoValor[$key],
                    'nome' => $request->atributoNome[$key],
                    'quantidade' => $request->atributoQuantidade[$key] ?? 0
                ]);
            }  
        }

        return $product;
      }
      return false;
    }

    public function delete($id): void
    {
        $product = Product::find($id);
        $imagens = ProductImage::where('product_id', $id)->get();
        if (count($imagens) > 0) {
            foreach ($imagens as $imagem) {
                if(File::exists($imagem->image)){
                    File::delete($imagem->image);
                }
            }
        }
        $product->delete();
    }

}