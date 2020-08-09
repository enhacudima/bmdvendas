<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Entradas;
use App\Ajustes;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }

    
    public function index()
    {   
      $this->authorize('produtos');
      $produtos=Produtos::orderby('name','asc')->get();
        return view('admin.produtos.index',compact('produtos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize('store_produtos');
        $this->validate($request, [
            'name'=>'required|min:3|unique:produtos,name|max:192',
            'codigoproduto'=>'required|max:192|unique:produtos,codigoproduto',
            'codigobarra'=>'required|max:192|unique:produtos,codigobarra',
            'brand'=>'required|max:192',
            'description'=>'required|string|max:192',
            'tipodeunidadedemedida'=>'required|string|max:192',
            'unidadedemedida'=>'required|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'stock'=>'required|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'peso'=>'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000'

        ]);

      $file_name="product/default.jpg";
      if (isset($request->image))
      {
          $file_name='product/'.time() .'.'. $request->file('image')->getClientOriginalExtension();
          $request->image->storeAs('public', $file_name); 
          
      }
        $data=$request->all();
        $data['image']=$file_name;
        
        
        Produtos::create($data);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->authorize('show_produtos');

        $produtos=Produtos::find($id);
        return view ('admin.produtos.show',compact('produtos'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      $this->authorize('edit_produtos');

        $produtos=request()->except(['_token']);
            $this->validate($request, [
            'name'=>['nullable','min:3','max:192',Rule::unique('produtos','name')->ignore($id,'id')],
            'codigoproduto'=>['required','max:192',Rule::unique('produtos','codigoproduto')->ignore($id,'id')],
            'codigobarra'=>['nullable','max:192',Rule::unique('produtos','codigobarra')->ignore($id,'id')],
            'brand'=>'nullable|max:192',
            'description'=>'nullable|string|max:192',
            'tipodeunidadedemedida'=>'nullable|string|max:192',
            'unidadedemedida'=>'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'peso'=>'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'stock'=>'nullable|regex:/^\d+(\.\d{1,2})?$/|numeric',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'status'=>'required',

        ]);
      $produtos=Produtos::find($id);
      $file_name=$produtos->image;
      if (isset($request->image))
      {

        $newFilename=$request->file('image')->getClientOriginalName();

          if ($produtos->image!="product/default.jpg") {
              
            Storage::delete('/public/'.$produtos->image);
          }
            $file_name='product/'.time() .'.'. $request->file('image')->getClientOriginalExtension();
            $request->image->storeAs('public', $file_name); 
          

          
      }
        $data=$request->except(['_token']);
        $data['image']=$file_name;
        
        Produtos::where('id',$id)
                ->update($data);

        return back()->with('success','Successfully Updated');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function entradaindex(){
      $this->authorize('entradas');
        $produtos=Produtos::orderby('name','asc')->where('status',1)->get();
        $entradas=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                            ->select('produtos_entradas.*','produtos.name','produtos.tipodeunidadedemedida','produtos.unidadedemedida','produtos.codigoproduto','produtos.image')
                            ->orderby('produtos.name','asc')
                            ->get();
        return view('admin.produtos.entradaindex', compact('produtos','entradas'));
    }

    public function entradastore(Request $request)
    {
        
      $this->authorize('store_entradas');

        $this->validate($request,[
          'produto_id'=>'required',
          'quantidade'=>'required',
          'precodecompra'=>'required|numeric',
          'margem_per'=>'required|numeric',
          'quantidade'=>'required|numeric',
          'data_exp'=>'nullable|date',
          'fornecedor'=>'nullable|string|max:255',
          'telefone'=>'nullable|numeric',
          'email_fornecedor'=>'nullable|email',
          'final_p' =>'required|numeric',
        ]);
        $produto=Produtos::find($request->produto_id);
        $entrada= new Entradas;
        $entrada->produto_id=$request->produto_id;
        $entrada->lot=time();
        $entrada->quantidade=$request->quantidade;
        $entrada->precodecompra=$request->precodecompra;
        $entrada->margem_per=$request->margem_per;
        $entrada->idusuario=$request->idusuario;
        $entrada->quantidade_unitaria=$request->quantidade*$produto->unidadedemedida;
        $entrada->custo_unitario=($request->precodecompra/$request->quantidade/$produto->unidadedemedida);
        $entrada->margem=$entrada->custo_unitario*($request->margem_per/100);
        $entrada->preco_final=$request->final_p;

        
        $entrada->data_exp=$request->data_exp;
        $entrada->fornecedor=$request->fornecedor;
        $entrada->telefone=$request->telefone;
        $entrada->email_fornecedor=$request->email_fornecedor;

        $entrada->save();

        return back()->with('success','Successfully Added');
    }

    public function ajustindex()
    {

      $this->authorize('ajuste');

      $produtos=Produtos::all();
      $lot=Entradas::distinct('lot')->get();
      $ajustes=Ajustes::join('produtos','produtos_ajustes.produto_id','produtos.id')
                      ->join('produtos_entradas','produtos_ajustes.lot_id','produtos_entradas.id')
                      ->select('produtos_ajustes.*','produtos_entradas.lot','produtos.name','produtos.tipodeunidadedemedida','produtos.unidadedemedida','produtos.codigoproduto','produtos.image')
                      ->get();
      
      return view('admin.produtos.ajustindex',compact('produtos','lot','ajustes'));  
    }

        public function lotid(Request $request)

    {

        if($request->ajax())
        {
        $output="";

        $data=Entradas::where('produto_id',$request->search)->get();

        if($data)
        {   foreach ($data as $key => $cil) {
            $output.='<option value="'.$cil->id.'">' .$cil->lot.'</option>';
            }

            return Response($output);
        }
        }
    }

    public function ajustestore(Request $request)
    {     
       $this->authorize('store_ajuste');  

        $data=$request->all();
        $this->validate($request, [
            'produto_id'=>'required',
            'lot_id'=>'required',
            'quantidade_unidade'=>'required',
            'decricao'=>'required|max:192',

        ]);

        Ajustes::create($data);

        return back()->with('success','Successfully Added');
    }


    public function lotshow($id)
    {   
       $this->authorize('show_lot');

        $produtos=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                            ->where('produtos_entradas.id',$id)
                            ->select('produtos_entradas.*','produtos.name','produtos.unidadedemedida')
                            ->get();

        return view('admin.produtos.entradashow',compact('produtos'));
    }

    public function loteupdate (Request $request)
    {   
         $this->authorize('edit_lot');

        $this->validate($request,[
          'produto_id'=>'required',
          'quantidade'=>'required',
          'precodecompra'=>'required|numeric',
          'margem_per'=>'required|numeric',
          'quantidade'=>'required|numeric',
          'data_exp'=>'nullable|date',
          'fornecedor'=>'nullable|string|max:255',
          'telefone'=>'nullable|numeric',
          'email_fornecedor'=>'nullable|email',
          'final_p' =>'required|numeric',
        ]);

        $produto=Produtos::find($request->produto_id);
        $entrada= new Entradas;
        $quantidade=$entrada->quantidade=$request->quantidade;
        $precodecompra=$entrada->precodecompra=$request->precodecompra;
        $margem_per=$entrada->margem_per=$request->margem_per;
        $idusuario=$entrada->idusuario=$request->idusuario;
        $quantidade_unitaria=$entrada->quantidade_unitaria=$request->quantidade*$produto->unidadedemedida;
        $custo_unitario=$entrada->custo_unitario=($request->precodecompra/$request->quantidade/$produto->unidadedemedida);
        $margem=$entrada->margem=$entrada->custo_unitario*($request->margem_per/100);
        $preco_final=$entrada->preco_final=$request->final_p;
        $status=$entrada->status=$request->status;

        $data_exp=$request->data_exp;
        $fornecedor=$request->fornecedor;
        $telefone=$request->telefone;
        $email_fornecedor=$request->email_fornecedor;

        $temp_name=Entradas::where('produto_id',$request->produto_id)->get();
        
        $ver=0;
        if ($status==1) 
        {
            foreach ($temp_name as $value) {
            if ($value->status==1) { 
                $ver=$value->status;
            }    
            }
            
            if ($ver==1){
            return back()->with('error','Não pode activar mas de 1 produto com mesmo nome');
              };
        };
          


        
        
        Entradas::where('id',$request->id)
                ->update(['quantidade'=>$quantidade,
                        'precodecompra'=>$precodecompra,
                        'margem_per'=>$margem_per,
                        'idusuario'=>$idusuario,
                        'quantidade_unitaria'=>$quantidade_unitaria,
                        'custo_unitario'=>$custo_unitario,
                        'margem'=>$margem,
                        'preco_final'=>$preco_final,
                        'status'=>$status,
                        'data_exp'=>$data_exp,
                        'fornecedor'=>$fornecedor,
                        'telefone'=>$telefone,
                        'email_fornecedor'=>$email_fornecedor,
                    ]);

        return back()->with('success','Successfully update');

        

       



    }
    public function getprodut(Request $request)
    {
        $produto = Produtos::find($request->id);

        return response()->json($produto);
    }
}
