<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
return 'Olá, seja bem vindo ao curso!';
});
 */
/* ROTAS COMUNS DO SITE *//* ATRIBUINDO O REFERIDO MIDDLEWARE A ESTA ROTA */
Route::get('/', 'PrincipalController@principal')->name('site.index') /* ->middleware(LogAcessoMiddleware::class) */;
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos') /* ->middleware(LogAcessoMiddleware::class) */;
Route::get('/contato', 'ContatoController@contato')->name('site.contato')->middleware('log.acesso');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');
/* ROTA DE LOGIN */
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

/* ROTAS ADMINISTRATIVAS DA APLICAÇÃO, SOMENTE PODEM SER ACESSADAS SE O USUÁRIO ESTIVER AUTENTICADO */
/* MIDDLEWARE AUTENTICACAO PASSANDO O PARAMETRO 'PADRAO' */
Route::middleware('autenticacao:padrao,visitante,p3,p4')->prefix('/app')->group(function () {
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    /* ROTAS DE AÇÕES PARA A AREA DE FORNECEDOR */
    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}/', 'FornecedorController@excluir')->name('app.fornecedor.excluir');
    

    /* ROTAS DE AÇÕES PARA A AREA DE PRODUTOS */
    /* foi utilizado o método 'resource' que cria automaticamente, todas as demais rotas padrão, não sendo
    necessário criar todas as rotas na mão, como em Fornecedor */
    /* produto */
    Route::resource('produto', 'ProdutoController');

    /* foi utilizado o método 'resource' que cria automaticamente, todas as demais rotas padrão, não sendo
    necessário criar todas as rotas na mão, como em Fornecedor */
    /* produto detalhes */
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    /* foi utilizado o método 'resource' que cria automaticamente, todas as demais rotas padrão, não sendo
    necessário criar todas as rotas na mão, como em Fornecedor */
    /* produto detalhes */
    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');
    /* Route::resource('pedido-produto', 'PedidoProdutoController'); */
    Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
    /* Route::delete('pedido-produto.destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy'); */
    Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('site.index') . '">clique aqui</a> para ir para página inicial';
});
