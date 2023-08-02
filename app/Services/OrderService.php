<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Order\OrderQuery;
use Illuminate\Support\Str;

class OrderService {

    protected $precototal = 0;

    public function getAll($request)
    {
        $filter = new OrderQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $ordem = Order::with('items')->get();
            return $ordem;
        } else {
            $ordem = Order::with('items')->where($queryItems)->get();
            return $ordem;
        }
    }

    public function getOrdersLinkedToUser($request)
    {
        $filter = new OrderQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]
        
        $limit = $request->limit ?? null;
        //dd($pagi);

        if (count($queryItems) == 0) {
            $orders = $request->user()->orders()->with('items')->limit($limit)->get();
            return $orders;
        } else {
            $orders = $request->user()->orders()->with('items')->where($queryItems)->get();
            return $orders;
        }
    }

    public function create($request)
    {
        //pegar produtos do carrinho
        //$produtosNoCart = $request->user()->cartItems()->get();
        //$request->productsInCart;
        //dd($produtosNoCart);
        //pegar produtos no estoque
        //$produtoEmEstoque = ProductAttribute::whereIn('id', $produtosNoCart->pluck('attribute_id'))->get();
        //dd($produtoEmEstoque);
            
        //checar se quantidades em estoque são maiores que a da compra.
        if($request->productsInCart){
            foreach ($request->productsInCart as $produto) {

                //dd($produto);

                $produtoEmEstoque = ProductAttribute::where('id', $produto['attribute_id'])->first();

                //dd($produtoEmEstoque);

                if($produtoEmEstoque['quantidade'] < $produto['quantidade']){
                    
                    $message = 'O produto: ' . $produtoEmEstoque->product->nome . ' ' . $produto['attributoName'] . ' têm apenas ' . $produtoEmEstoque['quantidade'] .
                    ' unidades em estoque';

                    //dd($message);

                    return ['message' => $message, 'status' => 404];
                }
            }
        } else {
            return false;
        }

        //criar Ordem
        $endereco = ' Cidade: ' . $request->user()->cidade . ', Bairro: ' .$request->user()->bairro . ', Logradouro: ' .
            $request->user()->logradouro . ', número: ' . $request->user()->numero . ', Estado: ' . $request->user()->uf;

        if($request->user()->cartItems()->count() > 0){
            $ordem = new Order;
            $ordem->user_id = $request->user()->id;
            $ordem->loja_id = $request->loja_id;
            $ordem->tracking_code = Str::random(6) . 'tm:' . time() . 'LID:' . $request->loja_id;
            $ordem->nome_completo = $request->user()->nome;
            $ordem->endereco = $endereco;
            $ordem->email = $request->user()->email;
            $ordem->numero_tel = $request->user()->telefone;
            $ordem->pincode = random_int(1000, 9999);
            $ordem->quantidade = $request->user()->cartItems()->count();
            $ordem->status_pedidos = "Em verificação";
            $ordem->preco_total = 00.00;
            $ordem->save();
        } else {
            return false;
        }
       
        if ($ordem) {

            //criacao
            foreach ($request->productsInCart as $produto) {
                //dd($produto);

                if($prodAtual = Product::where('id', $produto['product_id'])->first()){

                    $prodAtual->attributes()->where('id', $produto['attribute_id'])->decrement('quantidade', $produto['quantidade']);

                    $this->precototal += $prodAtual['preco_atual'] * $produto['quantidade'];

                    $OrderItems = OrderItem::create([
                    'order_id' => $ordem->id,
                    'product_id' => $produto['product_id'],
                    'attribute_id' => $produto['attribute_id'],
                    'quantidade' => $produto['quantidade'],
                    'nome' => $prodAtual['nome'] .' '. $produto['attributoName'],
                    'preco' => $prodAtual['preco_atual'] * $produto['quantidade']
                    ]);

                } else {
                    $ordem->delete();
                    return 'produto não está mais disponível ou não pôde ser encontrado';
                }
            }

            $ordem->update([
                'preco_total' => $this->precototal
            ]);

        } else {
            return false;
        }

       $request->user()->cartItems()->delete();
        return $ordem;

    }

    public function getById($id)
    {
        return $ordem = Order::where('id', $id)->with('items')->first();
    }


    
    public function update($request, $id)
    {

      $ordem = Order::find($id);

      if($ordem){

        $ordem->loja_id = $request->loja_id ?? $ordem->loja_id;
        $ordem->nome_completo = $request->nome_completo ?? $ordem->nome_completo;
        $ordem->status_pedidos = $request->status_pedidos ?? $ordem->status_pedidos;
        $ordem->preco_total = $request->preco_total ?? $ordem->preco_total;
        $ordem->save();

        return $ordem;
      }
      return false;
    }


    public function statusUpdateByUser($request)
    {
      $ordem = Order::find($request->id);
      if($ordem){

        $ordem->status_pedidos = "Recebido";
        $ordem->save();
        return $ordem;
      }
      return false;
    }

    

    public function delete($id): void
    {
        $ordem = Order::findOrFail($id);
        $ordem->delete();
    }
}