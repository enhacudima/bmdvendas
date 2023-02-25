<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Entradas;
use App\Ajustes;
use DB;
use Carbon\Carbon;
use App\VendasTroco;
use App\User;
use App\CarVenda;
use App\Car;
use App\ClienteVenda;
use App\Cliente;
use App\VendasTempMesa;
use App\Vendas;
use Auth;
use DataTables;


class ReportController extends Controller
{



    public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }


    public function reportMovimento()
    {

        $this->authorize('report');

        $movimentos = DB::table('produtos_venda_view')->get();


        return view('report.movimentos.report', compact('movimentos'));
    }

    public function reportStockAtual()
    {
        $this->authorize('report');

        $movimentos = DB::table('saldo_atual_view')
            ->get();


        return view('report.movimentos.stockAtual', compact('movimentos'));
    }


    public function reportMovimentoFilter(Request $request)
    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'radio' => 'required',
            'inicio' => 'required',
            'fim' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
        $radio = $request->radio;


        if ($radio == "movimento") {

            $movimentos = DB::table('produtos_venda_view')->whereBetween('created_at', [$inicio, $fim])->get();


            return view('report.movimentos.report', compact('movimentos'));
        } elseif ($radio == "ajuste") {
            return "This function has been disabled by the administrator";
            $movimentos = DB::table('produtos_entradas_view')
                ->whereBetween('produtos_ajustes_view.created_at', [$inicio, $fim])
                ->join('produtos', 'produtos_entradas_view.id', 'produtos.id')
                ->leftjoin('produtos_ajustes_view', 'produtos_entradas_view.entrada_lot', 'produtos_ajustes_view.lot')
                ->select(
                    'produtos.id',
                    'produtos.name',
                    'produtos_entradas_view.entrada_lot',
                    'produtos_ajustes_view.lot',
                    'produtos_entradas_view.entrada_preco',
                    DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada')
                )
                ->groupby('produtos_ajustes_view.lot', 'produtos.name', 'produtos.id', 'produtos_entradas_view.entrada_lot', 'entrada_preco')
                ->get();


            return view('report.movimentos.report', compact('movimentos'));
        }
    }

    public function reportMovimentoFilterAtual(Request $request)
    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'radio' => 'required',
            'inicio' => 'required',
            'fim' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
        $radio = $request->radio;


        if ($radio == "movimento") {

            $movimentos = DB::table('produtos_entradas_view')
                ->whereBetween('produtos_entradas_view.created_at', [$inicio, $fim])
                ->join('produtos', 'produtos_entradas_view.produto_id', 'produtos.id')
                ->leftjoin('produtos_ajustes_view', 'produtos_entradas_view.entrada_lot', 'produtos_ajustes_view.lot')
                ->select(
                    'produtos.id',
                    'produtos.name',
                    'produtos.stock',
                    'produtos.image',
                    DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada')
                )
                ->groupby('produtos.name', 'produtos.id', 'produtos.stock', 'produtos.image')
                ->get();


            return view('report.movimentos.stockAtual', compact('movimentos'));
        } elseif ($radio == "ajuste") {

            $movimentos = DB::table('produtos_entradas_view')
                ->whereBetween('produtos_ajustes_view.created_at', [$inicio, $fim])
                ->join('produtos', 'produtos_entradas_view.produto_id', 'produtos.id')
                ->leftjoin('produtos_ajustes_view', 'produtos_entradas_view.entrada_lot', 'produtos_ajustes_view.lot')
                ->select(
                    'produtos.id',
                    'produtos.name',
                    'produtos.stock',
                    'produtos.image',
                    DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada')
                )
                ->groupby('produtos.name', 'produtos.id', 'produtos.stock', 'produtos.image')
                ->get();


            return view('report.movimentos.stockAtual', compact('movimentos'));
        }
    }

    public function reportPagamento()
    {
        $this->authorize('report');

        $pagamentos = Vendas::select('fpagamento', DB::raw('Sum(valor) as total_venda'))->groupby('fpagamento')->get();


        return view('report.vendas.pagamento', compact('pagamentos'));
    }

    public function reportPagamentoFiltrar(Request $request)
    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
        ]);

        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);


        $pagamentos = Vendas::whereBetween('created_at', [$inicio, $fim])->select('fpagamento', DB::raw('Sum(valor) as total_venda'))->groupby('fpagamento')->get();
        return view('report.vendas.pagamento', compact('pagamentos'));
    }

    public function reportInflow()
    {
        $this->authorize('report');

        $movimentos = VendasTroco::join('mesa', 'venda_troco.mesa_id', 'mesa.id')
            ->join('users', 'venda_troco.user_id', 'users.id')
            ->select(
                'mesa.name as mesa',
                'users.name as username',
                DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                DB::raw('Sum(venda_troco.total_troco) as total_troco')
            )
            ->groupby('mesa.name', 'users.name')
            ->get();


        return view('report.vendas.inflow', compact('movimentos'));
    }



    public function reportInflowFilter(Request $request)
    {
        $this->authorize('report');
        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);



        $movimentos = VendasTroco::whereBetween('venda_troco.created_at', [$inicio, $fim])
            ->join('mesa', 'venda_troco.mesa_id', 'mesa.id')
            ->join('users', 'venda_troco.user_id', 'users.id')
            ->select(
                'mesa.name as mesa',
                'users.name as username',
                DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                DB::raw('Sum(venda_troco.total_troco) as total_troco')
            )
            ->groupby('mesa.name', 'users.name')
            ->get();


        return view('report.vendas.inflow', compact('movimentos'));
    }

    public function reportProdutoVenda()
    {
        $movimentos = Ajustes::join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
            ->select(
                'produtos.name as name',
                'produtos_ajustes.preco_uni as preco',
                DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
            )
            ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
            ->get();


        return view('report.vendas.produtos', compact('movimentos'));
    }


    public function reportProdutoVendaFilter(Request $request)

    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
            'radio' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
        $radio = $request->radio;

        if ($radio == "criacao") {
            $movimentos = Ajustes::whereBetween('produtos_ajustes.created_at', [$inicio, $fim])
                ->join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
                ->select(
                    'produtos.name as name',
                    'produtos_ajustes.preco_uni as preco',
                    DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
                )
                ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
                ->get();
            return view('report.vendas.produtos', compact('movimentos'));
        } elseif ($radio == "atualizacao") {
            $movimentos = Ajustes::whereBetween('produtos_ajustes.updated_at', [$inicio, $fim])
                ->join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
                ->select(
                    'produtos.name as name',
                    'produtos_ajustes.preco_uni as preco',
                    DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
                )
                ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
                ->get();

            return view('report.vendas.produtos', compact('movimentos'));
        }
    }
    public function reportAuditar()
    {
        $this->authorize('report');
        $user = User::get();

        $movimentos = Ajustes::join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
            ->select(
                'produtos.name as name',
                'produtos_ajustes.preco_uni as preco',
                DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
            )
            ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
            ->get();


        return view('report.vendas.auditar', compact('movimentos', 'user'));
    }


    public function reportAuditarFilter(Request $request)

    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
            'radio' => 'required',
            'agent' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
        $radio = $request->radio;
        $agent = $request->agent;
        $user = User::get();



        if ($radio == "criacao") {
            $movimentos = Ajustes::whereBetween('produtos_ajustes.created_at', [$inicio, $fim])
                ->where('produtos_ajustes.idusuario', $agent)
                ->join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
                ->select(
                    'produtos.name as name',
                    'produtos_ajustes.preco_uni as preco',
                    DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
                )
                ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
                ->get();


            return view('report.vendas.auditar', compact('movimentos', 'user'));
        } elseif ($radio == "atualizacao") {
            $movimentos = Ajustes::whereBetween('produtos_ajustes.updated_at', [$inicio, $fim])
                ->where('produtos_ajustes.idusuario', $agent)
                ->join('produtos', 'produtos_ajustes.produto_id', 'produtos.id')
                ->select(
                    'produtos.name as name',
                    'produtos_ajustes.preco_uni as preco',
                    DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade')
                )
                ->groupby('produtos.name', 'produtos_ajustes.preco_uni')
                ->get();
            return view('report.vendas.auditar', compact('movimentos', 'user'));
        }
    }

    public function vendascredito()
    {
        $this->authorize('report');

        $venda = ClienteVenda::select('cliente.nome as cname', 'cliente.apelido as clname', 'cliente.contacto1', 'cliente.contacto2', 'cliente_venda.created_at', 'users.name as uname', 'cliente_venda.codigo_venda', 'venda_troco.total_venda', 'venda_troco.total_pago', 'venda_troco.total_porpagar', 'venda_troco.total_troco')
            ->join('cliente', 'cliente_venda.cliente_id', 'cliente.id')
            ->join('users', 'cliente_venda.user_id', 'users.id')
            ->join('venda_troco', 'cliente_venda.codigo_venda', 'venda_troco.codigo_venda')
            ->where('form_type', 'credito')
            ->orderBy('cliente_venda.id', 'desc')
            ->get();



        return view('report.vendas.vendascredito', compact('venda'));
    }


    public function vendascreditofiltre(Request $request)
    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
        ]);

        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);

        $venda = ClienteVenda::whereBetween('cliente_venda.updated_at', [$inicio, $fim])
            ->join('cliente', 'cliente_venda.cliente_id', 'cliente.id')
            ->join('users', 'cliente_venda.user_id', 'users.id')
            ->join('venda_troco', 'cliente_venda.codigo_venda', 'venda_troco.codigo_venda')
            ->select('cliente.nome as cname', 'cliente.apelido as clname', 'cliente.contacto1', 'cliente.contacto2', 'cliente_venda.created_at', 'users.name as uname', 'cliente_venda.codigo_venda', 'venda_troco.total_venda', 'venda_troco.total_pago', 'venda_troco.total_porpagar', 'venda_troco.total_troco')
            ->get();
        return view('report.vendas.vendascredito', compact('venda'));
    }




    public function listapedidos(Request $request)
    {
        $this->authorize('report');

        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();

            $output = "";
            $data_mesa = VendasTempMesa::where('codigo_venda', $data['codigo_venda'])
                ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
                ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
                ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
                ->orderBy('vendas_temp_mesa.created_at', 'desc')
                ->get();

            foreach ($data_mesa as $key => $value) {
                $output .=
                    '<tr>
                            <td>' . $value->name . '</td>
                            <td>' . $value->preco_final . '</td>
                            <td>' . $value->quantidade . '</td>
                            <td>' . '<div class="col-md-4"><input type="text" class="subtot form-control" value="' . $value->quantidade * $value->preco_final . '" name="subtot" disabled="" /></div>' . '</td>
                        </tr>';
            }

            return response($output);
        }
    }




    public function pagamentocliente(Request $request)
    {
        $this->authorize('report');

        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();

            $data_mesa = VendasTroco::where('codigo_venda', $data['codigo_venda'])->latest()->first();

            return response($data_mesa);
        }
    }


    public function vendascar()
    {
        $this->authorize('report');

        /*$venda=VendasTempMesa::join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
              ->join('produtos','produtos_entradas.produto_id','produtos.id')
              ->join('car','vendas_temp_mesa.car_id','car.id')
              ->select('car.name as car_name','car.sname as car_sname','vendas_temp_mesa.created_at','car.contacto1','car.contacto2','car.matricula as matricula','produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id')
              ->orderBy('vendas_temp_mesa.created_at','desc')
              ->get();*/
        $venda = VendasTempMesa::join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
            ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
            ->join('paciente', 'vendas_temp_mesa.car_id', 'paciente.id')
            ->join('cliente', 'cliente.id', 'paciente.cliente_id')
            ->select('vendas_temp_mesa.created_at', 'produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'paciente.nome', 'paciente.numero_ficha', 'paciente.caderneta', 'paciente.raca', 'cliente.nome as cliente_nome', 'cliente.apelido', 'cliente.contacto1', 'cliente.contacto2')
            ->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();



        return view('report.vendas.vendascar', compact('venda'));
    }

    public function vendascarfilter(Request $request)
    {
        $this->authorize('report');

        $data = $request->all();
        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
        ]);
        $inicio = Carbon::parse($request->inicio);
        $fim = Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);

        $venda = VendasTempMesa::whereBetween('vendas_temp_mesa.updated_at', [$inicio, $fim])
            ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
            ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
            ->join('paciente', 'vendas_temp_mesa.car_id', 'paciente.id')
            ->join('cliente', 'cliente.id', 'paciente.cliente_id')
            ->select('vendas_temp_mesa.created_at', 'produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'paciente.nome', 'paciente.numero_ficha', 'paciente.caderneta', 'paciente.raca', 'cliente.nome as cliente_nome', 'cliente.apelido', 'cliente.contacto1', 'cliente.contacto2')
            ->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();



        return view('report.vendas.vendascar', compact('venda'));
    }


    public function todas_facturas()
    {
        return view('report.vendas.facturas');
    }

    public function facturas_allsource()
    {
        $data = VendasTempMesa::select('vendas_temp_mesa.*', 'venda_troco.total_venda', 'venda_troco.total_pago', 'venda_troco.total_porpagar', 'venda_troco.total_troco', 'users.name')
            ->join('venda_troco', 'venda_troco.codigo_venda', 'vendas_temp_mesa.codigo_venda')
            ->join('users', 'vendas_temp_mesa.user_id', '=', 'users.id')
            ->where('vendas_temp_mesa.codigo_venda', '!=', null)
            ->groupby('vendas_temp_mesa.codigo_venda')
            ->orderBy('vendas_temp_mesa.created_at', 'desc');

        return Datatables::of($data)
            ->addColumn('time', '{{\Carbon\Carbon::parse($created_at)->diffForHumans()}}')
            ->make(true);
    }
}
