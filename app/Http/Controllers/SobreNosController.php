<?php

namespace App\Http\Controllers;

/* NUNCA ESQUECER DO NAMESPACE DO MIDDLEWARE EM QUESTÃO */
use App\Http\Middleware\LogAcessoMiddleware;

class SobreNosController extends Controller
{
    /* FUNÇÃO CONSTRUTORA QUE TRAZ O MIDDLEWARE PARA O CONSTRUTOR */
    public function __construct()
    {
        $this->middleware(LogAcessoMiddleware::class);
    }
    public function sobreNos()
    {
        return view('site.sobre-nos');
    }
}
