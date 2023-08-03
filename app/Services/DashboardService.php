<?php

namespace App\Services;

use App\Models\Marca;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Hash;
use App\Filter\v1\Marca\DashboardQuery;


class DashboardService {


    public function getAll($request)
    {
        $filter = new DashboardQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $marcas = Marca::all();
            return $marcas;
        } else {
            $marcas = Marca::where($queryItems)->get();
            return $marcas;
        }
    }

    public function getData($request)
    {

        $totalDeProdutos = Product::count();
        $totalDePedidos = Order::count();
        $totalDeUsuarios = User::where('tipo_usuario', 'assist')->count();
        $totalDeAdmins = User::where('tipo_usuario', 'admin')->count();

        //tempo
        $dataHoje = Carbon::today();
        $dataEsteMes = Carbon::now()->month;
        $dataEsteAno = Carbon::now()->format('Y');
        //ordens
        
        $pedidosDeHoje = Order::where('loja_id', $request->user()->id)->whereDate('created_at', $dataHoje)->count();
        $pedidosDoMes = Order::where('loja_id', $request->user()->id)->whereMonth('created_at', $dataEsteMes)->whereYear('created_at', $dataEsteAno)->count();
        //$pedidosDoAno = Order::where('loja_id', $request->user()->id)->whereYear('created_at', $dataEsteAno)->count();


        //Pegar valor vendido do dia e do mes de cada orderItems.

        $itensDeOrdens = Order::where('loja_id', $request->user()->id)->where('status_pedidos','Recebido')->whereDate('created_at', $dataHoje)->get();

        $itensDeOrdensDoMes = Order::where('loja_id', $request->user()->id)->where('status_pedidos','Recebido')->whereMonth('created_at', $dataEsteMes)->get();


        $vendaDoDia = 0;
        foreach ($itensDeOrdens as $item) {
            $vendaDoDia += $item['preco_total'];
        }

        $vendaDoMes = 0;
        foreach ($itensDeOrdensDoMes as $item) {
            $vendaDoMes += $item['preco_total'];
        }


        return [
            "totalDeProdutos" => $totalDeProdutos,
            "totalDePedidos" => $totalDePedidos,
            "totalDeUsuarios" => $totalDeUsuarios,
            "totalDeAdmins" => $totalDeAdmins,
            "ordensDeHoje" => $pedidosDeHoje,
            "ordensDoMes" => $pedidosDoMes,
            //"ordensDoAno" => $pedidosDoAno,
            "vendaDoDia" => $vendaDoDia,
            "vendaDoMes" => $vendaDoMes
        ];

    }









    public function getAllData($request)
    {
        //de todas as lojas juntas, todas as ordens no sistema sem filtrar por loja.

        $totalDeProdutos = Product::count();
        $totalDePedidos = Order::count();
        $totalDeUsuarios = User::where('tipo_usuario', 'assist')->count();
        $totalDeAdmins = User::where('tipo_usuario', 'admin')->count();

        //tempo
        $dataHoje = Carbon::today();
        $dataEsteMes = Carbon::now()->month;
        $dataEsteAno = Carbon::now()->format('Y');
        //ordens
        
        $pedidosDeHoje = Order::whereDate('created_at', $dataHoje)->count();
        $pedidosDoMes = Order::whereMonth('created_at', $dataEsteMes)->whereYear('created_at', $dataEsteAno)->count();
        //$pedidosDoAno = Order::where('loja_id', $request->user()->id)->whereYear('created_at', $dataEsteAno)->count();


        //Pegar valor vendido do dia e do mes de cada orderItems.

        $itensDeOrdens = Order::where('status_pedidos','Recebido')->whereDate('created_at', $dataHoje)->get();

        $itensDeOrdensDoMes = Order::where('status_pedidos','Recebido')->whereMonth('created_at', $dataEsteMes)->get();


        $vendaDoDia = 0;
        foreach ($itensDeOrdens as $item) {
            $vendaDoDia += $item['preco_total'];
        }

        $vendaDoMes = 0;
        foreach ($itensDeOrdensDoMes as $item) {
            $vendaDoMes += $item['preco_total'];
        }


        return [
            "totalDeProdutos" => $totalDeProdutos,
            "totalDePedidos" => $totalDePedidos,
            "totalDeUsuarios" => $totalDeUsuarios,
            "totalDeAdmins" => $totalDeAdmins,
            "ordensDeHoje" => $pedidosDeHoje,
            "ordensDoMes" => $pedidosDoMes,
            //"ordensDoAno" => $pedidosDoAno,
            "vendaDoDia" => $vendaDoDia,
            "vendaDoMes" => $vendaDoMes
        ];

    }


}