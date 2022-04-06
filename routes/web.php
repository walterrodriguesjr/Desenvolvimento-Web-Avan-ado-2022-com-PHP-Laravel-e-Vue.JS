<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogAcessoMiddleware;

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
       /* ROTAS COMUNS DO SITE */                                                      /* ATRIBUINDO O REFERIDO MIDDLEWARE A ESTA ROTA */
Route::get('/', 'PrincipalController@principal')->name('site.index')/* ->middleware(LogAcessoMiddleware::class) */;
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos')/* ->middleware(LogAcessoMiddleware::class) */;
Route::get('/contato', 'ContatoController@contato')->name('site.contato')->middleware('log.acesso');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');
Route::get('/login', function(){return 'Login';})->name('site.login');

/* ROTAS ADMINISTRATIVAS DA APLICAÇÃO, SOMENTE PODEM SER ACESSADAS SE O USUÁRIO ESTIVER AUTENTICADO */
Route::prefix('/app')->group(function() {                                                   /* INSERIDO UM ENCADEAMENTO DE 2 MIDDLEWARES */
    Route::get('/clientes', function(){return 'Clientes';})->name('app.clientes')->middleware('autenticacao');
    Route::get('/fornecedores', 'FornecedorController@index')->name('app.fornecedores')->middleware('autenticacao');
    Route::get('/produtos', function(){return 'produtos';})->name('app.produtos')->middleware('autenticacao');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});
