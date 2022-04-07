<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuario e/ou senha não existe';
        };
        if($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        };
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    /* FUNÇÃO RESPONSÁVEL POR TRATAR OS DADOS DE LOGIN E SENHA E ENVIAR-LOS PARA O BACK-END */
    public function autenticar(Request $request)
    {
        /* VARIAVEL '$regras' RECEBE UM ARRAY ASSOCIATIVO COM A VALIDAÇÃO DE USUARIO E SENHA */
        $regras = [
            'usuario' => 'email',
            'senha' => 'required',
        ];

        /* MENSAGENS DE FEEDBACK DE VALIDAÇÃO */
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!',
        ];

        $request->validate($regras, $feedback);

        /* recuperando os parâmetros do formulário */
        $email = $request->get('usuario');
        $password = $request->get('senha');

        

        /* iniciar o model user */
        $user = new User();
        $usuario = $user->where('email', $email)
                       ->where('password', $password)
                       ->get()
                       ->first();
        

        if(isset($usuario->name)){
            /* definindo o inicio de seção */
            session_start();
            /* iniciando a superglobal session */
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            
            return redirect()->route('app.home');

        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    /* A FUNÇÃO SAIR É PARA FAZER O LOGOUT DA SESSÃO */
    public function sair(){
        /* MÉTODO QUE DESTROY A SESSÃO, DESLOGANDO O USUÁRIO, EM SEGUIDA O REDIRECT MANDA O USUARIO PARA O INDEX DO SITE */
        session_destroy();
        return redirect()->route('site.index');
    }
}
