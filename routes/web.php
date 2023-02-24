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

Route::get('/clear-cache-all', function() {

    Artisan::call('cache:clear');
    dd("Cache Clear All");

});


Auth::routes();

//home contact form
Route::resource('contactFormData','ContactFormController');
Route::post('contactFormData/store','ContactFormController@store');



//route admin
//Route::get('admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function(){

Voyager::routes();

});


Route::group(['middleware' => ['auth']], function(){

Route::get('/home', 'HomeController@index')->name('home');
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
Route::post('efectuarpagamentocredito','VendasController@venda/facturacredito');
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
Route::get('search-pacient','PacienteController@SearchPaciente')->name('search-pacient');

Route::get('get-produt','ProdutoController@getprodut');

Route::get('venda/facturaVenda/{id}/{cliente}','VendasController@facturaVenda');
Route::get('venda/factura/{id}','VendasController@factura');
Route::get('vendas/find/bulck','VendasController@findbulck');
Route::get('vendas/produtos/stock','VendasController@produtosStock');


//Ficha de pacientes
//Route::get('ficha-clinica/{id}','FichaPacienteController@index');
Route::resource('ficha-clinica', 'FichaPacienteController');
Route::resource('paciente', 'PacienteController');
Route::get('ficha-clinica/seguimento/{id}','FichaPacienteController@seguimento');
Route::post('ficha_clinica/altera/estado','FichaPacienteController@altera_estado');
Route::get('ficha_clinica/paciente/{id}','FichaPacienteController@paciente_nova_ficha');
Route::post('ficha-clinica/{id}','FichaPacienteController@update');

//venda
Route::get('getstocktovenda','VendasController@getstocktovenda');

//calendario
Route::get('calendario','CalendarioController@index')->name('calendario');

Route::post('calendario','CalendarioController@addEvent')->name('calendario.add');

Route::get('calendario/detalhes/{id}','CalendarioController@show');

Route::post('calendario/detalhes/update/{id}','CalendarioController@edit');

Route::get('calendario/delete/{id}','CalendarioController@destroy');

//email
Route::get('email', 'EmailController@index');
Route::get('email/all', 'EmailController@all');
Route::get('email/allsource', 'EmailController@allsource');

Route::get('emailtry/{id}', 'EmailController@try');

Route::post('enviaremail', 'EmailController@enviaremail');


//email inbox
Route::get('email/inbox','EmailController@inbox');
Route::get('email/inboxData','EmailController@inboxData');
Route::get('email/read/{id}','EmailController@read');
Route::get('email/reply/{id}','EmailController@reply');

//report dowload
Route::get('report/index','ReportExtratController@index');
Route::get('report/new','ReportExtratController@new');
Route::resource('meusficheiros','ReportExtratController');
Route::get('meusficheiros/deletefile/{file}','ReportExtratController@deletefile');
Route::get('meusficheiros/all/deletefile','ReportExtratController@alldeletefile');
Route::get('file/download/{filename}', 'FileDownloadController@index')->name('file/download');
Route::post('report/filtro','ReportExtratController@filtro');

//Recipt
Route::get('vendas/ultima/{id}','VendasController@ultimaVenda');
Route::get('vendas/ultima/print/{id}','VendasController@ultimaPrint');
Route::get('vendas/ultimas/vendas','VendasController@ultimas');

//dashboard
Route::get('chart-line', 'ChartController@chartLine');
Route::get('chart-line-ajax', 'ChartController@chartLineAjax');
Route::get('chart-line-ajax-api2', 'ChartController@chartLineAjax2');
Route::get('send-banho-venda','CarController@facturacao');
//tags
Route::get('/tags/find', 'FichaPacienteController@find');
Route::get('tags/tags','TagsController@index');
Route::resource('tags', 'TagsController');
Route::get('tags/remove/list/{id}','FichaPacienteController@tagRemove');

//racas
Route::get('racas','RacasController@index');
Route::post('especie/store','RacasController@especie_store');
Route::post('raca/store','RacasController@raca_store');
Route::post('pelagem/store','RacasController@pelagem_store');

//report Facturas
Route::get('vendas_facturas','ReportController@todas_facturas');
Route::get('facturas/allsource','ReportController@facturas_allsource');

//eliminar venda
Route::get('vendas/eliminar/venda','VendasController@eliminar_venda');

//fim das rotas
});
//todas rotas devem ser definidas acima
