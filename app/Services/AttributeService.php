<?php

namespace App\Services;

use App\Models\Attribute;
use App\Filter\v1\Attribute\AttributeQuery;
use Illuminate\Support\Str;


class AttributeService {


    public function getAll($request)
    {
        $filter = new AttributeQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $attributes = Attribute::all();
            return $attributes;
        } else {
            $attributes = Attribute::where($queryItems)->get();
            return $attributes;
        }
    }

    public function create($request)
    {
        $attribute = new Attribute;
        $attribute->nome = $request->nome;
        $attribute->code = Str::random(20);
        $attribute->save();

        return $attribute;

    }

    public function getById($id)
    {
        return Attribute::find($id);
    }

    public function update($request, $id)
    {

      $attribute = Attribute::find($id);
      if($attribute){

        $attribute->nome = $request->nome ?? $attribute->nome;
        //$attribute->code = $request->code ?? $attribute->code;
        $attribute->save();
        return $attribute;
      }
      return false;
    }

    public function delete($id): void
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
    }
}