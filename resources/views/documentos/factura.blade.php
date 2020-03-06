@extends('adminlte::page')

@section('title', ' | Fatura')

@section('content_header')
     
@stop

@section('content')

          
<page id="printableArea" name="printableArea"> 
     <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
             Pelos e Patas
            <small class="pull-right">Data: {{\Carbon\Carbon::now()->format('d-m-Y')}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
           <strong>Pelos e Patas, SA</strong><br>
            Av. de Moçambique, Bairro do Zimpeto.<br>  
            Cell: (+258) 84 150 003 1<br>
            Fixo: (+258) 82 150 003 1<br>
            Email: pelosepatas@gmail.com<br>
            Maputo, Moçambique
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          
          
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b><img src="{{ asset('imglogo/pp.jpg') }}"   alt="logo" width="200" height="100"></b><br>  
          <br>
          <b>&emsp;&emsp;&emsp;&emsp;Factura Nᵒ  #</b>
          
        </div>
        <!-- /.col -->
      </div>

      <br>
      <!-- /.row -->
      
      <h5><strong></strong></h5>
      <div class="box box-solid box-danger">
      <div class="row invoice-info">

        <div class="col-sm-4 invoice-col">
        <address>
            <br>
             <b> Data Limite Pagamento:</b> {{\Carbon\Carbon::now()->adddays(7)->format('d-m-Y')}}<br><br /> 
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
        <address>
            <br>

        </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <address>
            <br>
           
              
            </address>
        </div>
      
      </div>

    </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Nº</th>
              <th>Descrição</th>
              <th>Quantidade</th>
              <th>Valor</th>
            
            </tr>
            </thead>
            <tbody>
            @php($t=0)
            @php($t1=0)
            @php($t2=0)
            @php($t3=0)
            @php($t4=0)
            @if(isset($data_mesa))
            @foreach($data_mesa as $key => $factura)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$factura->name}}</td>
              <td>{{$factura->quantidade}}</td>
              <td>{{number_format(round($factura->preco_final*$factura->quantidade,2), 2, ',', ' ')}}</td>
              @php($t=$factura->preco_final*$factura->quantidade+$t)
            </tr>
            @endforeach
            @endif
            </tbody>
          <tfoot>
            <tr class="table-danger">

              <th></th>
              <th></th>
              <th>Total</th>
              <th>{{number_format(round($t,2), 2, ',', ' ')}}</th>
              </tr>
          </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead"><strong><i class="fa fa-fw fa-cc-visa"></i>Dados Bancários:</strong></p>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <b>Banco:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;##<br>  
          <b>Titular:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;###<br>  
          <b>Nᵒ de Conta:</b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;### (MZN)<br>
          <b>NIB:</b> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;#####<br>   
          </p>
        </div>
        <!-- /.col detalhes por encargos -->

      </div>
      <!-- /.row -->
     </section>
</page>


    
    <section class="invoice">
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#" type="button" onclick="printDiv('printableArea')" class="btn btn-default"><i class="fa fa-print fa-1x" aria-hidden="true"></i> Imprimir</a>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
           <i class="fa fa-share-alt" ></i> Guardar
          </button>
        </div>
      </div>
    </section>
      
    </div>             

        </div>   
            




@stop
