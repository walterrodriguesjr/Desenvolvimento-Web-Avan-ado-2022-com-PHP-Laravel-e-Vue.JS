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
Route::get('/login', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

/* ROTAS ADMINISTRATIVAS DA APLICAÇÃO, SOMENTE PODEM SER ACESSADAS SE O USUÁRIO ESTIVER AUTENTICADO */
/* MIDDLEWARE AUTENTICACAO PASSANDO O PARAMETRO 'PADRAO' */
Route::middleware('autenticacao:padrao,visitante,p3,p4')->prefix('/app')->group(function () {
    Route::get('/clientes', function () {return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', 'FornecedorController@index')->name('app.fornecedores');
    Route::get('/produtos', function () {return 'produtos';})->name('app.produtos');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('site.index') . '">clique aqui</a> para ir para página inicial';
});
