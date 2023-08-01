<?php

namespace App\Services;

use App\Models\Banner;
use App\Filter\v1\Banner\BannerQuery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BannerService {

    public function getAll($request)
    {
        $filter = new BannerQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $banneres = Banner::all();
            return $banneres;
        } else {
            $banneres = Banner::where($queryItems)->get();
            return $banneres;
        }
    }

    public function getById($id)
    {
        return Banner::find($id);
    }

    public function create($request)
    {
        
        if($request->file('image')){    
            $uploadPath = 'storage/banners/';
            $i = 0;
            foreach($request->file('image') as $imageFile){
                //dd($imageFile);
                //$imageFile = $request->file('image');
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                

                
                //verificar se existe directory
                if (!File::isDirectory($uploadPath)) {
                    
                    Storage::makeDirectory($uploadPath, 0777);
                   //File::makeDirectory($uploadPath, 0777, true, true);
                }
                //stokar file
                $imageFile->move($uploadPath, $filename);

                $finalImagePathName = $uploadPath.$filename;

                $banner = Banner::create([
                    'nome' => $request->nome,
                    'image' => $finalImagePathName,
                ]);
            }
            return 'Criado ' .$i. ' banners';
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

    public function deleteBanner($id): void
    {
        if ($imagem = Banner::where('id', $id)->first()) {
            if(File::exists($imagem->image)){
                File::delete($imagem->image);
            }
        }
        $imagem->delete();
    }
}