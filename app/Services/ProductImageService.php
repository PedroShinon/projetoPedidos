<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Filter\v1\ProductImage\ProductImageQuery;
use Illuminate\Support\Facades\File;


class ProductImageService {

    public function getAll($request)
    {
        $filter = new ProductImageQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $images = ProductImage::all();
            return $images;
        } else {
            $images = ProductImage::where($queryItems)->get();
            return $images;
        }
    }

    public function getById($id)
    {
        return ProductImage::find($id);
    }

    public function create($request)
    {
        $product = Product::find($request->id);
        if($request->file('image')){    
            $uploadPath = 'storage/products/';
            $i = 0;
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
            return $producter = Product::with('productImages')->where('id', $product->id)->first();
        }
        return false;
        
    }


    //public function update($request, $id)
    //{
    //
      //$imagem = ProductImage::find($id);
      //if($imagem){
    //
       // $imagem->nome = $request->nome ?? $marca->nome;
       // $imagem->save();
      //  return $marca;
      //}
      //return false;
    //}

    public function deleteImage($id): void
    {
        if ($imagem = ProductImage::where('id', $id)->first()) {
            if(File::exists($imagem->image)){
                File::delete($imagem->image);
            }
        }
        $imagem->delete();
    }
}