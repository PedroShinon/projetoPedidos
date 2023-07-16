<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
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
            $products = Product::all();
            return $products;
        } else {
            $products = Product::with('productImages')->where($queryItems)->get();
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
            'user_id' => $request->user()->id,
            'nome' => $request->nome,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'descricao' => $request->descricao,
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
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        //PAROU BEM AQUI JOÃO PEDRO
        if($request->variants){
            foreach($request->variants as $key => $variant){
                $product->productVariant()->create([
                    'product_id' => $product->id,
                    'color_id' => $variant,
                    'quantidade' => $request->variantQuantity[$key] ?? 0
                ]);
            }
                
        }

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

        if($request->variants){
            foreach($request->variants as $key => $variant){
                $product->productVariant()->create([
                    'product_id' => $product->id,
                    'color_id' => $variant,
                    'quantidade' => $request->variantQuantity[$key] ?? 0
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