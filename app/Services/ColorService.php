<?php

namespace App\Services;

use App\Models\Color;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Color\ColorQuery;


class ColorService {

    public function getAll($request)
    {
        $filter = new ColorQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $colors = Color::all();
            return $colors;
        } else {
            $colors = Color::where($queryItems)->get();
            return $colors;
        }
    }

    public function create($request)
    {
        $color = Color::create([
            'cor' => $request->cor,
            'hexdecimal' => $request->hexdecimal,
        ]);

        return $color;
    }

    public function getById($id)
    {
        return Color::find($id);
    }

    public function update($request, $id)
    {
      $color = Color::find($id);
      if($color){
        $color->update([
            'cor' => $request->cor ?? $color->cor,
            'hexdecimal' => $request->hexdecimal ?? $color->hexdecimal,
        ]);
        return $color;
      }
      return false;
    }

    public function delete($id): void
    {
        $color = Color::findOrFail($id);
        $color->delete();
    }
}