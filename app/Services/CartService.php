<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Cart\CartQuery;


class CartService {


    public function getAll($request)
    {
        $filter = new CartQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $carts = Cart::all();
            return $carts;
        } else {
            $carts = Cart::where($queryItems)->get();
            return $carts;
        }
    }

    public function getCartsLinkedToUser($request)
    {
        $filter = new CartQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]
        
        $limit = $request->limit ?? null;
        //dd($pagi);

        if (count($queryItems) == 0) {
            $carts = $request->user()->cartItems()->with('produto', 'prodAtributo')->limit($limit)->get();
            //dd($carts);
            return $carts;
        } else {
            $carts = $request->user()->cartItems()->with('produto', 'prodAtributo')->get();
            return $carts;
        }
    }

    public function create($request)
    {
        $cart = new Cart;
        $cart->user_id = $request->user()->id;
        $cart->image = $request->image;
        $cart->product_id = $request->product_id;
        $cart->attributo = $request->attributo;
        $cart->attribute_id = $request->attribute_id;
        $cart->quantidade = $request->quantidade;
        $cart->save();

        return $cart;

    }

    public function getById($id)
    {
        return Cart::find($id);
    }

    public function update($request, $id)
    {
    
      $cart = Cart::find($id);
      if($cart){
    
        $cart->quantidade = $request->quantidade ?? $cart->quantidade;
        $cart->save();
        return $cart;
      }
      return false;
    }

    public function delete($id): void
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
    }
}