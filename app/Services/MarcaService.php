<?php

namespace App\Services;

use App\Models\Marca;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Marca\MarcaQuery;


class MarcaService {


    public function getAll($request)
    {
        $filter = new MarcaQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $marcas = Marca::all();
            return $marcas;
        } else {
            $marcas = Marca::where($queryItems)->get();
            return $marcas;
        }
    }

    public function create($request)
    {
        $marca = new Marca;
        $marca->nome = $request->nome;
        $marca->save();

        return $marca;

    }

    public function getById($id)
    {
        return Marca::find($id);
    }

    public function update($request, $id)
    {

      $marca = Marca::find($id);
      if($marca){

        $marca->nome = $request->nome ?? $marca->nome;
        $marca->save();
        return $marca;
      }
      return false;
    }

    public function delete($id): void
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
    }
}