<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//route admin
//Route::get('admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('mesa','MesaController');
Route::get('criarmesa','MesaController@index');
Route::post('storemesa','MesaController@store');
Route::post('updatemesa','MesaController@updatemesa');

Route::resource('produto','ProdutoController');
Route::get('criarproduto','ProdutoController@index');
Route::post('storeproduto','ProdutoController@store');
Route::post('produto/update/{id}','ProdutoController@update');
Route::get('produto_entrada','ProdutoController@entradaindex');
Route::post('store_produto_entrada','ProdutoController@entradastore');
Route::get('ajust_index','ProdutoController@ajustindex');
Route::post('store_produto_ajuste','ProdutoController@ajustestore');
Route::get('show_produto_entrada/{id}','ProdutoController@lotshow');
Route::post('produto/entrada/update','ProdutoController@loteupdate');
//obter lot_id
Route::get('findlotid','ProdutoController@lotid');
Route::get('vendasindex/{id}','VendasController@index');
Route::get('carvendasindex/{car_id}/{mesa_id}/{user_id}','VendasController@carindex');
Route::get('vendascreditoindex/{id}','VendasController@creditoindex');
Route::post('saveselection','VendasController@saveselection');
Route::get('saveselection','VendasController@saveselection');
Route::get('getmesatem','VendasController@getmesatem');
Route::post('atualizarvendatemp','VendasController@atualizarvendatemp');
Route::post('efectuarpagamento','VendasController@efectuarpagamento');
Route::post('efectuarpagamentocredito','VendasController@efectuarpagamentocredito');
Route::post('efectuarcredito','VendasController@efectuarcredito');
Route::get('listapedidos','VendasController@listapedidos');
Route::get('creditarvenda','VendasController@creditarvenda');
Route::post('savecredito','VendasController@savecredito');


// relatorios 
Route::get('report_produt','ReportController@reportMovimento');
Route::get('report_stock_atual','ReportController@reportStockAtual');
Route::post('report_movimetos_filter','ReportController@reportMovimentoFilter');
Route::post('report_movimetos_filter_atual','ReportController@reportMovimentoFilterAtual');
Route::post('report_inflow_filter','ReportController@reportInflowFilter');
Route::post('report_produto_venda_filter','ReportController@reportProdutoVendaFilter');
Route::post('report_auditar_filter','ReportController@reportAuditarFilter');
Route::get('report_inflow','ReportController@reportInflow');
Route::get('report_produto_venda','ReportController@reportProdutoVenda');
Route::get('report_auditar','ReportController@reportAuditar');
Route::get('report_vendacredito','ReportController@vendascredito');
Route::get('listapedidoscliente','ReportController@listapedidos');
Route::get('pagamentocliente','ReportController@pagamentocliente');
Route::post('report_vendacredito_filter','ReportController@vendascreditofiltre');
Route::get('report_vendacar','ReportController@vendascar');
Route::post('report_vendacar_filter','ReportController@vendascarfilter');
Route::get('report_pagamento','ReportController@reportPagamento');
Route::post('report_pagamentos_filter','ReportController@reportPagamentoFiltrar');




Route::post('apagalinha','VendasController@apagalinha');

//car wash
Route::get('carindex/{id}','CarController@carindex');
Route::get('carcreate/{id}','CarController@carcreate');
Route::get('carshow/{id}/{mesa_id}','CarController@carshow');
Route::post('storcar','CarController@storcar');
Route::post('atualizar','CarController@atualizar');
Route::get('carshow/{id}/{mesa_id}','CarController@carshow');
Route::get('cartemp/{id}/{mesa_id}/{user_id}','CarController@cartemp');

Route::post('carapagalinha','CarController@carapagalinha');

//Cliente 
Route::get('index_cliente','ClienteController@indexcliente');
Route::post('storcliente','ClienteController@storcliente');
Route::get('clienteshow/{id}','ClienteController@clienteshow');
Route::post('updatecliente','ClienteController@updatecliente');
Route::get('searchcliente','ClienteController@searchcliente')->name('searchloanid');

Route::get('get-produt','ProdutoController@getprodut');




