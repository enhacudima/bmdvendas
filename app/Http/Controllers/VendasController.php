<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entradas;
use App\VendasTempMesa;
use App\Mesa;
use App\Vendas;
use App\VendasTroco;
use App\Ajustes;
use Auth;
use Session;
use App\ClienteVenda;
use App\CarTemp;
use App\Car;
use App\CarVenda;
use DB;
use App\Cliente;
use App\Traits\UniqueIDTrait;

class VendasController extends Controller
{

    use UniqueIDTrait;

    public $minQtG = 10;

    public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }

    public function getstocktovenda()
    {
        $this->authorize('venda');
        $produtos = DB::table('produtos_venda_view')->where('produto_status', 1)->where('status', 1)->get();

        return response()->json($produtos);
    }

    public function index($id)
    {
        $this->authorize('venda');
        $mesa_id = $id;

        $data_mesa = $this->data_mesa($mesa_id);
        $mesa = Mesa::find($mesa_id);
        //dd($mesa_id);
        return view('vendas.index', compact('mesa_id', 'data_mesa', 'mesa'));
    }

    public function produtosStock(Request $request)
    {
        $this->authorize('venda');
        $term = $request->key;
        $produtos = DB::table('produtos_venda_view')
            ->where('status', 1)
            ->where('produto_status', 1)
            ->Where(function ($query) use ($term) {
                $query->orwhere('codigoproduto', 'like', '%' . $term . '%')
                    ->orwhere('name', 'like', '%' . $term . '%')
                    ->orwhere('brand', 'like', '%' . $term . '%')
                    ->orwhere('codigoproduto', 'like', '%' . $term . '%')
                    ->orwhere('entrada_preco', 'like', '%' . $term . '%');
            })
            ->get();

        $output = '';

        if ($term == null) {
            return response()->json($output);
        }


        $url = \URL::to('storage') . '/';
        foreach ($produtos as $key => $value) {
            $q = $value->saldo;
            $msg = "Lote:" . $value->entrada_lot;
            if ($q <= 0) {
                $msg = "<code>Produto sem estoque (atualize o stock do lote " . $value->entrada_lot . ")</code>";
            }

            $output .= '<tr><td><img src="' . $url . $value->image . '" style="width:150px;  clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;"></td>
        <td>
        <b>Nome:</b> ' . $value->name . '<br>
        <b>Marca:</b> ' . $value->brand . '<br>
        <b>Unidade:</b> ' . $value->tipodeunidadedemedida . ' (' . $value->unidadedemedida . ')' . '<br>
        <b>Codigo:</b> ' . $value->codigoproduto . '<br>
        <b style="color:green">Preço: ' . number_format(round($value->entrada_preco, 2)) . ' MT</b><br>
        <b style="color:orange">Preço de Revendedor: ' . number_format(round($value->preco_final_revendedor, 2)) . 'Mtn</b><br>
        <b>Em Stock:</b> ' . number_format(round($q, 2), 2, ',', ' ') . ' Unt ' . $msg . '
        </td>
        <td>' .
                $this->getCartButton($q, $value->id, $value->entrada_id)
                . '</td>
        </tr>';
        }
        return response()->json($output);
    }

    private function getCartButton($q, $id, $entrada)
    {
        if ($q <= 0) {
            return "";
        } else {
            return '<button  class="btn btn-block btn-success btn-flat" onclick="produtostockadd(' . $id . ','. $entrada.')" style="" value="' . $id . '"><i class="fa fa-shopping-cart"></i></button>';
        }
    }

    public function carindex($car_id, $mesa_id, $user_id)
    {
        $this->authorize('venda');

        $car_temp = CarTemp::find($car_id);

        $car_name = Car::find($car_temp->car_id);

        $car_ =  $car_name->id;

        $produtos = DB::table('produtos_venda_view')->where('produto_status', 1)->where('status', 1)->get();

        $data_mesa = VendasTempMesa::where('mesa_id', $mesa_id)->whereNull('codigo_venda')->where('vendas_temp_mesa.car_id', $car_)
            ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
            ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
            ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
            //->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();
        $mesa = Mesa::find($mesa_id);


        //dd($data_mesa);


        return view('vendas.carindex', compact('produtos', 'mesa_id', 'data_mesa', 'mesa', 'car_id', 'user_id', 'car_name'));
    }


    public function creditoindex($id) //clone de vendas normais
    {
        $this->authorize('venda');

        $mesa_id = $id;
        $produtos = Entradas::join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
            ->select('produtos_entradas.*', 'produtos.name')
            ->where('produtos_entradas.status', '!=', '0')
            ->get();
        $data_mesa = $this->data_mesa($mesa_id);
        $mesa = Mesa::find($mesa_id);
        return view('vendas.creditoindex', compact('produtos', 'mesa_id', 'data_mesa', 'mesa'));
    }



    public function  saveselection(Request $request)
    {
        $this->authorize('venda');
        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();
            $value = $data['produt_id'];
            $entrada_id = $data['entrada_id'];
            if (isset($data['idbulk'])) {
                $identificador_de_bulk = $data['idbulk'];
            } else {
                $identificador_de_bulk = 'mesa' . '_' . time();
            }

            $mesa_id = $data['mesa_id'];
            if ($request->formtype == "car") {
                $car_temp = CarTemp::find($data['car_id']);
                $car_name = Car::find($car_temp->car_id);
                $car_ =  $car_name->id;
            }

            $mesa = Mesa::find($mesa_id);
            $mesa->status = 0;
            $mesa->idusuario = Auth::user()->id;
            $mesa->save();

            if ($request->formtype == "car") {
                $carvenda = new CarVenda();
                $carvenda->user_id = $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id
                $carvenda->car_id = $car_;
                $carvenda->mesa_id = $mesa_id = $mesa_id;
                $carvenda->codigo_venda = $identificador_de_bulk;
                $carvenda->save();
            }


            //verficando duplicados
            if ($request->formtype == "car") {
                $duplicate = VendasTempMesa::where('produto_id', $value)
                    ->where('mesa_id', $data['mesa_id'])
                    ->where('car_id', $car_)
                    ->whereNull('codigo_venda')
                    ->first();
            } else {
                $duplicate = VendasTempMesa::where('produto_id', $value)
                    ->where('mesa_id', $data['mesa_id'])
                    ->whereNull('codigo_venda')
                    ->first();
            }
            if ($duplicate) {
                $quantidadeNova = $duplicate->quantidade + 1;
                $duplicate->update([
                    'quantidade' => $quantidadeNova,
                    'price_unit' => $this->getUnitPrice($entrada_id, $quantidadeNova)
                ]);
            } else {


                $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id

                $produtos = new VendasTempMesa();
                $produtos->user_id = $user_id;
                $produtos->produto_id = $value;
                $produtos->quantidade = $quantidate = 1;
                $produtos->entrada_id = $entrada_id;
                $produtos->identificador_de_bulk = $identificador_de_bulk;
                $produtos->mesa_id = $data['mesa_id'];
                //$produtos->price_unit = $this->getUnitPrice($entrada_id, $quantidate);

                if ($request->formtype == "car") {
                    $produtos->car_id = $car_name->id;
                }
                $check = $this->CheckQt($entrada_id, $quantidate);
                if($check){
                    $produtos->save();
                    $this->getUnitPrices($produtos->identificador_de_bulk);
                }
            }




            if ($request->formtype == "car") {

                $data_mesa = VendasTempMesa::where('mesa_id', $data['mesa_id'])
                    ->whereNull('codigo_venda')->where('vendas_temp_mesa.car_id', $car_)
                    ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
                    ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
                    ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
                    //->orderBy('vendas_temp_mesa.created_at', 'desc')
                    ->get();
            } else {
                $data_mesa = $this->data_mesa($data['mesa_id']);
            }
            $output = $this->dataMesaTemp($data_mesa);
            return response($output);
        }
    }

    private function getUnitPrice($entrada_id, $quantidadeNova)
    {
        $entrada = Entradas::find($entrada_id);
        if ($quantidadeNova >= $this->minQtG) {
            if($entrada->preco_final_revendedor > 0){
                return $entrada->preco_final_revendedor;
            }
            return $entrada->preco_final;
        }else{
            return $entrada->preco_final;
        }
    }

    private function CheckQt($entrada_id, $quantidadeNova)
    {
        $entrada = DB::table('produtos_venda_view')->where('entrada_id',$entrada_id)->first();
        if ($entrada->saldo >= $quantidadeNova) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarvendatemp(Request $request)
    {
        $this->authorize('actualizar_venda_temp_venda');
        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();
            $idbulk = $data['mesa_id'];
            $quantidade = $data['quantidade'];

            if ($request->formtype == "car") {
                $car_temp = CarTemp::find($data['car_id']);
                $car_name = Car::find($car_temp->car_id);
                $car_ =  $car_name->id;
            }
            foreach ($data['id'] as $key => $value) {
                $produtos = VendasTempMesa::find($value);
                $produtos->user_id = auth()->user()->id;
                $produtos->quantidade = $quantidade[$key];
                //$produtos->price_unit = $this->getUnitPrice($produtos->entrada_id, $quantidade[$key]);

                $check = $this->CheckQt($produtos->entrada_id, $quantidade[$key]);
                if ($check) {
                    $produtos->save();
                    $this->getUnitPrices($produtos->identificador_de_bulk);
                }
            }

            if ($request->formtype == "car") {

                $data_mesa = VendasTempMesa::where('mesa_id', $data['mesa_id'])
                    ->whereNull('codigo_venda')
                    ->where('vendas_temp_mesa.car_id', $car_)
                    ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
                    ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
                    ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
                    //->orderBy('vendas_temp_mesa.created_at', 'desc')
                    ->get();
            } else {

                $data_mesa = $this->data_mesa($data['mesa_id']);
            }
            $output = $this->dataMesaTemp($data_mesa);
            return response($output);
        }
    }

    private function getUnitPrices($identificador_de_bulk)
    {
        $prods = VendasTempMesa::where('identificador_de_bulk', $identificador_de_bulk)->get();
        $tQt = VendasTempMesa::where('identificador_de_bulk', $identificador_de_bulk)->sum('quantidade');
        foreach ($prods as $key => $prod) {
            $prod->price_unit = $this->getUnitPrice($prod->entrada_id, $tQt);
            $prod->save();
        }

    }

    function data_mesa($mesa_id, $filter = 'mesa_id')
    {
        return VendasTempMesa::where($filter, $mesa_id)->whereNull('codigo_venda')
            ->join('produtos_venda_view', 'produtos_venda_view.entrada_id', 'vendas_temp_mesa.entrada_id')
            ->select('produtos_venda_view.name', 'vendas_temp_mesa.quantidade', 'vendas_temp_mesa.price_unit as preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
            //->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();
    }


    function data_ultima_venda($pagamento, $filter = 'vendas_temp_mesa.codigo_venda')
    {
        return VendasTempMesa::where($filter, $pagamento)
            ->join('produtos_venda_view', 'produtos_venda_view.entrada_id', 'vendas_temp_mesa.entrada_id')
            ->leftjoin('cliente_venda', 'cliente_venda.codigo_venda', 'vendas_temp_mesa.codigo_venda')
            ->leftjoin('cliente', 'cliente.id', 'cliente_venda.cliente_id')
            ->select('produtos_venda_view.codigoproduto', 'produtos_venda_view.name', 'vendas_temp_mesa.quantidade', 'produtos_venda_view.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk', 'cliente.nome', 'cliente.tipo', 'cliente.nuit', 'vendas_temp_mesa.codigo_venda')
            ->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();
    }

    public function listapedidos(Request $request)
    {
        $this->authorize('venda');
        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();

            $output = "";
            $data_mesa = $this->data_mesa($data['mesa_id']);

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


    public function efectuarpagamento(Request $request)
    {
        $this->authorize('venda_pagamento');
        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();
            $detalhes = $data['detalhes'];
            $referencia = $data['referencia'];
            $valor = $data['valor'];
            $identificador_bulck = 'pagamento' . '_' . time();
            $mesa_id = $data['mesa_id'];
            $porpagar = $data['porpagar'];
            $pago = $data['pago'];
            $ppago = $data['ppago'];
            $_troco = $data['_troco'];
            $formtype = $data['formtype'];
            $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id


            if (isset($data['cliente'])) { //verficação se a venda é credito ou não
                $cliente = $data['cliente'];

                $ClienteVenda = new ClienteVenda();
                $ClienteVenda->cliente_id = $cliente;
                $ClienteVenda->form_type = $formtype;
                $ClienteVenda->codigo_venda = $identificador_bulck;
                $ClienteVenda->user_id = $user_id;
                $ClienteVenda->save();
            }

            foreach ($data['fpagamento'] as $key => $value) {
                $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id
                $vendas = new Vendas();
                $vendas->user_id = $user_id;
                $vendas->mesa_id = $mesa_id;
                $vendas->fpagamento = $value;
                $vendas->detalhes = $detalhes[$key];
                $vendas->referencia = $referencia[$key];
                $vendas->valor = $valor[$key];
                $vendas->identificador_bulck = $identificador_bulck;
                $vendas->save();



                if (!empty($data['car_id'])) {
                    $car_temp = CarTemp::find($data['car_id']);
                    $car_name = Car::find($car_temp->car_id);
                    $car_ =  $car_name->id;

                    VendasTempMesa::where('mesa_id', $mesa_id)
                        ->whereNull('codigo_venda')
                        ->where('car_id', $car_)
                        ->update(['codigo_venda' => $identificador_bulck]);
                } else {

                    VendasTempMesa::where('mesa_id', $mesa_id)
                        ->whereNull('codigo_venda')
                        ->whereNull('car_id')
                        ->update(['codigo_venda' => $identificador_bulck]);
                }
            }

            $troco = new VendasTroco();
            $troco->user_id = $user_id;
            $troco->codigo_venda = $identificador_bulck;
            $troco->mesa_id = $mesa_id;
            $troco->total_venda = $porpagar;
            $troco->total_pago = $pago;
            $troco->total_porpagar = $ppago;
            $troco->total_troco = $_troco;
            $troco->save();

            VendasTempMesa::where('mesa_id', $mesa_id)
                ->whereNull('codigo_venda')
                ->update(['codigo_venda' => $identificador_bulck]);

            $data_mesa = VendasTempMesa::where('mesa_id', $data['mesa_id'])
                ->where('codigo_venda', $identificador_bulck)
                ->get();

            foreach ($data_mesa as $key => $value) {
                $ajuste = new Ajustes;
                $ajuste->produto_id = $value->produto_id;
                $ajuste->lot_id = $value->entrada_id;
                $ajuste->quantidade_unidade = $value->quantidade;
                $ajuste->tipo = "venda";
                $ajuste->idusuario = $user_id;
                $ajuste->decricao = $identificador_bulck;
                $ajuste->preco_uni = $value->preco_uni;
                $ajuste->save();
            }

            $mesa = Mesa::find($mesa_id);
            $mesa->status = 1;
            $mesa->idusuario = Auth::user()->id;
            $mesa->save();
        }
    }
    public function ultimaVenda($pagamento)
    {
        $this->authorize('venda');

        $itens = $this->data_ultima_venda($pagamento, "vendas_temp_mesa.codigo_venda");
        if (empty($itens)) {
            return back()->with('error', "Venda não encotrada");
        }
        $trocos = VendasTroco::where('codigo_venda', $pagamento)->first();

        $pdf = app('dompdf.wrapper')->loadView('documentos.recipt', compact('itens', 'trocos'));
        return $pdf->stream('invoice.pdf');
    }

    public function ultimaPrint($pagamento)
    {
        $this->authorize('venda');
        $itens = $this->data_ultima_venda($pagamento, "vendas_temp_mesa.codigo_venda");
        if (empty($itens)) {
            return back()->with('error', "Venda não encotrada.");
        }
        $trocos = VendasTroco::where('codigo_venda', $pagamento)->first();
        $pdf = app('dompdf.wrapper')->loadView('documentos.recipt_print', compact('itens', 'trocos'));
        return $pdf->stream('invoice.pdf');
    }


    public function efectuarpagamentocredito(Request $request)
    {
        $this->authorize('efectuar_pagamento_credito_venda');
        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();
            $detalhes = $data['detalhes'];
            $referencia = $data['referencia'];
            $valor = $data['valor'];
            $identificador_bulck = $data['codigo_venda'];
            $olldVenda = Vendas::where('identificador_bulck', $identificador_bulck)->first();
            $mesa_id = $olldVenda->mesa_id;
            $porpagar = $data['porpagar'];
            $pago = $data['pago'];
            $ppago = $data['ppago'];
            $_troco = $data['_troco'];
            $formtype = $data['formtype'];
            $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id


            foreach ($data['fpagamento'] as $key => $value) {
                $user_id = (!Auth::guest()) ? Auth::user()->id : null; //user_id
                $vendas = new Vendas();
                $vendas->user_id = $user_id;
                $vendas->mesa_id = $mesa_id;
                $vendas->fpagamento = $value;
                $vendas->detalhes = $detalhes[$key];
                $vendas->referencia = $referencia[$key];
                $vendas->valor = $valor[$key];
                $vendas->identificador_bulck = $identificador_bulck;
                $vendas->save();
            }

            $troco = new VendasTroco();
            $troco->user_id = $user_id;
            $troco->codigo_venda = $identificador_bulck;
            $troco->mesa_id = $mesa_id;
            $troco->total_venda = $porpagar;
            $troco->total_pago = $pago;
            $troco->total_porpagar = $ppago;
            $troco->total_troco = $_troco;
            $troco->save();
        }
    }





    public function  apagalinha(Request $request)
    {
        $this->authorize('apagar_linha_venda');

        if ($request->ajax()) {
            $request->except('_token');
            $data = $request->all();

            if ($request->formtype == "car") {
                $car_temp = CarTemp::find($data['car_id']);
                $car_name = Car::find($car_temp->car_id);
                $car_ =  $car_name->id;
            }


            $identificador_de_bulk = 'mesa' . '_' . time();
            $linha_id = $data['linha_id'];
            $mesa_id = VendasTempMesa::find($linha_id);

            VendasTempMesa::where('id', $linha_id)->delete();
            $this->getUnitPrices($mesa_id->identificador_de_bulk);

            if ($request->formtype == "car") {
                $data_mesa = VendasTempMesa::where('mesa_id', $mesa_id->mesa_id)->whereNull('codigo_venda')->where('vendas_temp_mesa.car_id', $car_)
                    ->join('produtos_entradas', 'vendas_temp_mesa.produto_id', 'produtos_entradas.id')
                    ->join('produtos', 'produtos_entradas.produto_id', 'produtos.id')
                    ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'produtos_entradas.preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
                    //->orderBy('vendas_temp_mesa.created_at', 'desc')
                    ->get();
            } else {
                $data_mesa = VendasTempMesa::where('mesa_id', $mesa_id->mesa_id)
                    ->whereNull('codigo_venda')
                    ->join('produtos', 'vendas_temp_mesa.produto_id', 'produtos.id')
                    ->select('produtos.name', 'vendas_temp_mesa.quantidade', 'vendas_temp_mesa.price_unit as preco_final', 'vendas_temp_mesa.id', 'vendas_temp_mesa.identificador_de_bulk')
                    //->orderBy('vendas_temp_mesa.created_at', 'desc')
                    ->get();
            }
            $output = $this->dataMesaTemp($data_mesa);

            if (!isset($data_mesa[0])) {
                $mesa = Mesa::find($mesa_id->mesa_id);
                $mesa->status = 1;
                $mesa->save();
            }

            return \Response::json($output);
        }
    }


    public function factura($id)
    {
        $this->authorize('venda_factura');

        $data_mesa = $this->data_mesa($id, 'identificador_de_bulk');

        $cliente = DB::table('cliente_venda')->where('codigo_venda', $data_mesa[0]->codigo_venda)->join('cliente', 'cliente.id', 'cliente_venda.cliente_id')->first();
        return view('documentos.factura', compact('data_mesa', 'cliente'));
    }

    public function facturaVenda($id, $cliente)
    {
        $this->authorize('venda_factura');

        $data_mesa = $this->data_mesa($id);
        $cliente = DB::table('cliente')->find($cliente);


        return view('documentos.factura', compact('data_mesa', 'cliente'));
    }

    public function findbulck(Request $request)
    {
        $this->authorize('venda');

        $id = $request->mesa_id;

        $data_mesa = VendasTempMesa::where('mesa_id', $id)->whereNull('codigo_venda')->first();

        return \Response::json($data_mesa);
    }

    public function ultimas()
    {

        $this->authorize('venda');

        $data = VendasTempMesa::select('vendas_temp_mesa.*', 'venda_troco.total_venda', 'venda_troco.total_pago', 'venda_troco.total_porpagar', 'venda_troco.total_troco')
            ->join('venda_troco', 'venda_troco.codigo_venda', 'vendas_temp_mesa.codigo_venda')
            ->where('vendas_temp_mesa.codigo_venda', '!=', null)
            ->limit(4)
            ->groupby('vendas_temp_mesa.codigo_venda')
            ->orderBy('vendas_temp_mesa.created_at', 'desc')
            ->get();
        return response()->json($data);
    }

    function dataMesaTemp($data_mesa)
    {
        $output = "";
        foreach ($data_mesa as $key => $value) {
            $output .=
                '
                    <tr>
                        <input type="text" id="idbulk" name="idbulk" hidden="true" value="' . $value->identificador_de_bulk . '">
                        <input step="0.01" type="number" id="id[]" name="id[]" hidden="true" value="' . $value->id . '">
                        <td>
                        <input class="form-control col-md-5" type="text" name="produt" id="produt"  disabled="" value="' . $value->name . '">
                        </td>
                        <td>
                        <input class="form-control col-md-2" step="0.01" type="number" name="preco_final[]" id="preco_final[]" disabled="true" value="' . $value->preco_final . '">
                        </td>
                        <td>
                        <input onChange="updateQuantity(this.value,' . $value->id . ')" class="form-control col-md-2  " data-id="' . $value->id . '" step="0.01" type="number" name="quantidade[]" id="quantidade[]"  value="' . ($value->quantidade ? $value->quantidade : 0)  . '">
                        </td>
                        <td>
                        <input  class="form-control col-md-2" step="0.01" type="number" name="total[]" id="total[]"  disabled="" value="' . $value->quantidade * $value->preco_final . '">
                        </td>
                        <td>
                        <a type="submit"class="btn btn-block btn-danger btn-flat col-md-1"  data-value="' . $value->id . '" id="delete" href="#">
                        <i class="fa fa-trash-o fa-lg" ></i></a>
                        </td>
                    </tr>
                    ';

        }

        return $output;
    }

    public function eliminar_venda(Request $request)
    {
        $this->authorize('store_ajuste');
        $id = $request->data;

        Ajustes::where('tipo', 'venda')->where('decricao', $id)->delete();
        ClienteVenda::where('codigo_venda', $id)->delete();
        VendasTroco::where('codigo_venda', $id)->delete();
        Vendas::where('identificador_bulck', $id)->delete();
        VendasTempMesa::where('codigo_venda', $id)->delete();
        $arr = array('msg' => 'Successfully removed', 'status' => true);
        return Response()->json($arr);
    }
}
