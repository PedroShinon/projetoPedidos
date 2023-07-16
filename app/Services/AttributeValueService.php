<?php

namespace App\Services;

use App\Models\AttributeValue;
use App\Filter\v1\AttributeValue\AttributeValueQuery;
use Illuminate\Support\Str;


class AttributeValueService {


    public function getAll($request)
    {
        $filter = new AttributeValueQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $attributeValues = AttributeValue::all();
            return $attributeValues;
        } else {
            $attributeValues = AttributeValue::where($queryItems)->get();
            return $attributeValues;
        }
    }

    public function create($request)
    {
        $attributeValue = new AttributeValue;
        $attributeValue->attribute_id = $request->attribute_id;
        $attributeValue->nome = $request->nome;
        $attributeValue->save();

        return $attributeValue;

    }

    public function getById($id)
    {
        return AttributeValue::find($id);
    }

    public function update($request, $id)
    {

      $attributeValue = AttributeValue::find($id);
      if($attributeValue){
        $attributeValue->attribute_id = $request->attribute_id ?? $attribute->attribute_id;
        $attributeValue->nome = $request->nome ?? $attribute->nome;
        $attributeValue->save();
        return $attributeValue;
      }
      return false;
    }

    public function delete($id): void
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();
    }
}