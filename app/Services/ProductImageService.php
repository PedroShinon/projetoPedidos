<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;


class ProductImageService {



    public function getById($id)
    {
        return ProductImage::find($id);
    }

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