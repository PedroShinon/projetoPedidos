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
        $category = Category::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'image' => $request->image,
            'status' => $request->status ?? false,
        ]);

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
        $category->update([
            'nome' => $request->nome ?? $category->nome,
            'descricao' => $request->descricao ?? $category->descricao,
            'image' => $request->image ?? $category->image,
            'status' => $request->status ?? $category->status,
        ]);
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