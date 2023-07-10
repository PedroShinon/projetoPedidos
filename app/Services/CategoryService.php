<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Category\CategoryQuery;


class CategoryService {


    public function getAll($request)
    {
        $filter = new CategoryQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $categorys = Category::all();
            return $categorys;
        } else {
            $categorys = Category::where($queryItems)->get();
            return $categorys;
        }
    }

    public function create($request)
    {
        $category = new Category;
        $category->nome = $request->nome;
        $category->descricao = $request->descricao;
        $category->visivel = $request->visivel ?? true;
        $category->save();

        return $category;

    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function update($request, $id)
    {

      $category = Category::find($id);
      if($category){

        $category->nome = $request->nome ?? $category->nome;
        $category->descricao = $request->descricao ?? $category->descricao;
        $category->visivel = $request->visivel ?? $category->visivel;
        $category->save();
        return $category;
      }
      return false;
    }

    public function delete($id): void
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}