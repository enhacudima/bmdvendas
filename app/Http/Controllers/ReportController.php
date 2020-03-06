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
use App\vendas;

class ReportController extends Controller
{
    

        public function __construct()
    {
        $this->middleware('auth');


    }

    
        public function reportMovimento()
    {   
        $movimentos=DB::table('produtos_entradas_view')
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    }

            public function reportStockAtual()
    {   
        $movimentos=DB::table('produtos_entradas_view')
                            ->join('produtos','produtos_entradas_view.produto_id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos.stock','produtos.image',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos.name','produtos.id','produtos.stock','produtos.image')
                            ->get();
                     
                            
        return view('report.movimentos.stockAtual',compact('movimentos'));
    }


    public function reportMovimentoFilter(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'radio'=>'required',
            'inicio'=>'required',
            'fim'=>'required',
            ]);
	  $inicio=Carbon::parse($request->inicio);
      $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
      $radio=$request->radio;


    	if ($radio=="movimento") {

    		        $movimentos=DB::table('produtos_entradas_view')
    		        		->whereBetween('produtos_entradas_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    		
    	}elseif ($radio=="ajuste") {
    		    	$movimentos=DB::table('produtos_entradas_view')
    		        		->whereBetween('produtos_ajustes_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot','produtos_entradas_view.entrada_preco',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos_ajustes_view.lot','produtos.name','produtos.id','produtos_entradas_view.entrada_lot','entrada_preco')
                            ->get();
                     
                            
        return view('report.movimentos.report',compact('movimentos'));
    	}

    }

        public function reportMovimentoFilterAtual(Request $request)
    {
        $data=$request->all();
        $this->validate($request, [
            'radio'=>'required',
            'inicio'=>'required',
            'fim'=>'required',
            ]);
      $inicio=Carbon::parse($request->inicio);
      $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
      $radio=$request->radio;


        if ($radio=="movimento") {

        $movimentos=DB::table('produtos_entradas_view')
                            ->whereBetween('produtos_entradas_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.produto_id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos.stock','produtos.image',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos.name','produtos.id','produtos.stock','produtos.image')
                            ->get();
                     
                            
        return view('report.movimentos.stockAtual',compact('movimentos'));
            
        }elseif ($radio=="ajuste") {

        $movimentos=DB::table('produtos_entradas_view')
                            ->whereBetween('produtos_ajustes_view.created_at',[$inicio,$fim])
                            ->join('produtos','produtos_entradas_view.produto_id','produtos.id')
                            ->leftjoin('produtos_ajustes_view','produtos_entradas_view.entrada_lot','produtos_ajustes_view.lot')
                            ->select('produtos.id','produtos.name','produtos.stock','produtos.image',DB::raw('Sum(produtos_ajustes_view.total_ajuste) as total_ajuste '),
                                    DB::raw('Sum(produtos_entradas_view.total_entrada) as total_entrada'))
                            ->groupby('produtos.name','produtos.id','produtos.stock','produtos.image')
                            ->get();
                     
                            
        return view('report.movimentos.stockAtual',compact('movimentos'));
        }

    }

    public function reportPagamento()
    {
        $pagamentos=Vendas::select('fpagamento',DB::raw('Sum(valor) as total_venda'))->groupby('fpagamento')->get();


        return view('report.vendas.pagamento',compact('pagamentos'));
    }

    public function reportPagamentoFiltrar(Request $request)
    {

        $data=$request->all();
        $this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            ]);

          $inicio=Carbon::parse($request->inicio);
          $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);


      $pagamentos=Vendas::whereBetween('created_at',[$inicio,$fim])->select('fpagamento',DB::raw('Sum(valor) as total_venda'))->groupby('fpagamento')->get();  
      return view('report.vendas.pagamento',compact('pagamentos')); 
    }

    public function reportInflow()
    {
    	        $movimentos=VendasTroco::join('mesa','venda_troco.mesa_id','mesa.id')
    	        			->join('users','venda_troco.user_id','users.id')
                            ->select('mesa.name as mesa','users.name as username',
                            		DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                                    DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                            		DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                            		DB::raw('Sum(venda_troco.total_troco) as total_troco'))
                            ->groupby('mesa.name','users.name')
                            ->get();
                     
                         
        return view('report.vendas.inflow',compact('movimentos'));
    }



    public function reportInflowFilter(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            ]);
		  $inicio=Carbon::parse($request->inicio);
	      $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);



    	        $movimentos=VendasTroco::whereBetween('venda_troco.created_at',[$inicio,$fim])
    	        			->join('mesa','venda_troco.mesa_id','mesa.id')
    	        			->join('users','venda_troco.user_id','users.id')
                            ->select('mesa.name as mesa','users.name as username',
                            		DB::raw('Sum(venda_troco.total_venda) as total_venda'),
                                    DB::raw('Sum(venda_troco.total_pago) as total_pago'),
                            		DB::raw('Sum(venda_troco.total_porpagar) as total_porpagar'),
                            		DB::raw('Sum(venda_troco.total_troco) as total_troco'))
                            ->groupby('mesa.name','users.name')
                            ->get();
                     
                         
        return view('report.vendas.inflow',compact('movimentos'));
    }

        public function reportProdutoVenda()
    {
    	        $movimentos=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                     
                  
        return view('report.vendas.produtos',compact('movimentos'));
    }        


    	public function reportProdutoVendaFilter(Request $request)

    {	
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            'radio' => 'required',
            ]);
		  	$inicio=Carbon::parse($request->inicio);
	      	$fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
	       	$radio=$request->radio;

	       	if ($radio=="criacao") {
    	        $movimentos=Ajustes::whereBetween('produtos_ajustes.created_at',[$inicio,$fim])
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                return view('report.vendas.produtos',compact('movimentos'));            
	       		
	       	}elseif ($radio=="atualizacao") {
	       		$movimentos=Ajustes::whereBetween('produtos_ajustes.updated_at',[$inicio,$fim])
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();

                return view('report.vendas.produtos',compact('movimentos'));
	       	}

                     
                  

    }
            public function reportAuditar()
    {
    			$user=User::get();

    	        $movimentos=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                     
                  
        return view('report.vendas.auditar',compact('movimentos','user'));
    }   


        	public function reportAuditarFilter(Request $request)

    {	
    	$data=$request->all();
    	$this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            'radio' => 'required',
            'agent'=> 'required',
            ]);
		  	$inicio=Carbon::parse($request->inicio);
	      	$fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);
	       	$radio=$request->radio;
	       	$agent=$request->agent;
	       	$user=User::get(); 



	       	if ($radio=="criacao") {
    	        $movimentos=Ajustes::whereBetween('produtos_ajustes.created_at',[$inicio,$fim])
    	        			->where('produtos_ajustes.idusuario',$agent)
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                          
                  
	       		return view('report.vendas.auditar',compact('movimentos','user'));
	       	}elseif ($radio=="atualizacao") {
	       		$movimentos=Ajustes::whereBetween('produtos_ajustes.updated_at',[$inicio,$fim])
	       					->where('produtos_ajustes.idusuario',$agent)
    	        			->join('produtos','produtos_ajustes.produto_id','produtos.id')
                            ->select('produtos.name as name','produtos_ajustes.preco_uni as preco',
                            		DB::raw('Sum(produtos_ajustes.quantidade_unidade) as quantidade'))
                            ->groupby('produtos.name','produtos_ajustes.preco_uni')
                            ->get();
                return view('report.vendas.auditar',compact('movimentos','user'));            

               
	       	}

                  
                  
	       	 
    }

    public function vendascredito ()
    {

    $venda=ClienteVenda::join('cliente','cliente_venda.cliente_id','cliente.id')->join('users','cliente_venda.user_id','users.id')->join('venda_troco','cliente_venda.codigo_venda','venda_troco.codigo_venda')->select('cliente.name as cname','cliente.name as clname','cliente.contacto1','cliente.contacto2','cliente_venda.created_at','users.name as uname','cliente_venda.codigo_venda', 'venda_troco.total_venda','venda_troco.total_pago','venda_troco.total_porpagar','venda_troco.total_troco')->get();



    return view('report.vendas.vendascredito',compact('venda'));        
    }


        public function vendascreditofiltre (Request $request)
    {

        $data=$request->all();
        $this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            ]);
          $inicio=Carbon::parse($request->inicio);
          $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);    

    $venda=ClienteVenda::whereBetween('cliente_venda.updated_at',[$inicio,$fim])->join('cliente','cliente_venda.cliente_id','cliente.id')->join('users','cliente_venda.user_id','users.id')->join('venda_troco','cliente_venda.codigo_venda','venda_troco.codigo_venda')->select('cliente.name as cname','cliente.name as clname','cliente.contacto1','cliente.contacto2','cliente_venda.created_at','users.name as uname','cliente_venda.codigo_venda', 'venda_troco.total_venda','venda_troco.total_pago','venda_troco.total_porpagar','venda_troco.total_troco')->get();



    return view('report.vendas.vendascredito',compact('venda'));        
    }




        public function listapedidos(Request $request)
    {
      if($request->ajax())
      {
        $request->except('_token'); 
          $data=$request->all();

          $output="";
            $data_mesa=VendasTempMesa::where('codigo_venda',$data['codigo_venda'])
              ->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
              ->join('produtos','produtos_entradas.produto_id','produtos.id')
              ->select('produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id','vendas_temp_mesa.identificador_de_bulk')
              ->orderBy('vendas_temp_mesa.created_at','desc')
              ->get();

            foreach ($data_mesa as $key => $value) {
              $output.=
                       '<tr>
                            <td>'.$value->name.'</td>
                            <td>'.$value->preco_final.'</td>
                            <td>'.$value->quantidade.'</td>
                            <td>'.'<div class="col-md-4"><input type="text" class="subtot form-control" value="'.$value->quantidade * $value->preco_final.'" name="subtot" disabled="" /></div>'.'</td>
                        </tr>';
            }

             return response($output);
      }
    }




        public function pagamentocliente(Request $request)
    {
      if($request->ajax())
      {
        $request->except('_token'); 
            $data=$request->all();

            $data_mesa=VendasTroco::where('codigo_venda',$data['codigo_venda'])->latest()->get();

             return response($data_mesa);
      }
    }


    public function vendascar ()
    {

    $venda=VendasTempMesa::join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
              ->join('produtos','produtos_entradas.produto_id','produtos.id')
              ->join('car','vendas_temp_mesa.car_id','car.id')
              ->select('car.name as car_name','car.sname as car_sname','vendas_temp_mesa.created_at','car.contacto1','car.contacto2','car.matricula as matricula','produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id')
              ->orderBy('vendas_temp_mesa.created_at','desc')
              ->get();


    
    return view('report.vendas.vendascar',compact('venda'));        
    }

    public function vendascarfilter (Request $request)
    {

        $data=$request->all();
        $this->validate($request, [
            'inicio'=>'required',
            'fim'=>'required',
            ]);
          $inicio=Carbon::parse($request->inicio);
          $fim=Carbon::parse($request->fim)->addHours(23)->addMinutes(59)->addSecond(59);  

    $venda=VendasTempMesa::whereBetween('vendas_temp_mesa.updated_at',[$inicio,$fim])->join('produtos_entradas','vendas_temp_mesa.produto_id','produtos_entradas.id')
              ->join('produtos','produtos_entradas.produto_id','produtos.id')
              ->join('car','vendas_temp_mesa.car_id','car.id')
              ->select('car.name as car_name','car.sname as car_sname','vendas_temp_mesa.created_at','car.contacto1','car.contacto2','car.matricula as matricula','produtos.name','vendas_temp_mesa.quantidade','produtos_entradas.preco_final','vendas_temp_mesa.id')
              ->orderBy('vendas_temp_mesa.created_at','desc')
              ->get();


    
    return view('report.vendas.vendascar',compact('venda'));        
    }


}
