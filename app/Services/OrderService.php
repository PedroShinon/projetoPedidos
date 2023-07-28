<?php

namespace App\Services;

use App\Models\Order;
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
            $ordem = Order::all();
            return $ordem;
        } else {
            $ordem = Order::where($queryItems)->get();
            return $ordem;
        }
    }

    public function create($request)
    {
        $endereco = ' Cidade: ' . $request->user()->cidade . ' Bairro: ' .$request->user()->bairro . ' Logradouro: ' .
            $request->user()->logradouro . ' número: ' . $request->user()->numero . ' Estado: ' . $request->user()->uf;

        $ordem = new Order;
        $ordem->user_id = $request->user()->id;
        $ordem->loja_id = $request->loja_id;
        $ordem->tracking_code = Str::random(5) . 'tm:' . time() . 'LID:' . $request->loja_id;
        $ordem->nome_completo = $request->user()->nome;
        $ordem->endereco = $endereco;
        $ordem->email = $request->user()->email;
        $ordem->numero_tel = $request->user()->telefone;
        $ordem->pincode = random_int(1000, 9999);
        $ordem->quantidade = count($request->produtos);
        $ordem->status_pedidos = "Em verificação";
        $ordem->preco_total = 00.00;
        $ordem->save();

        if ($ordem) {
            foreach ($request->produtos as $produto) {

                //dd($produto);

                $this->precototal += $produto['preco'];

                $OrderItems = OrderItem::create([
                'order_id' => $ordem->id,
                'product_id' => $produto['product_id'],
                'attribute_id' => $produto['attribute_id'],
                'quantidade' => $produto['quantidade'],
                'preco' => $produto['preco']
                ]);
            }

            $ordem->update([
                'preco_total' => $this->precototal
            ]);

        } else {
            return false;
        }

        return $ordem;

    }

    public function getById($id)
    {
        return Order::find($id);
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

    public function delete($id): void
    {
        $ordem = Order::findOrFail($id);
        $ordem->delete();
    }
}