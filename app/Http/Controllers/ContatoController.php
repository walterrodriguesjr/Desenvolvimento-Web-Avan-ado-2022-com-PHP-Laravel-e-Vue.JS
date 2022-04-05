<?php

namespace App\Http\Controllers;

use App\MotivoContato;
use App\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {

        //realizar a validação dos dados do formulário recebidos no request
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ];
        $feedback = [
            'nome.required' => 'O campo "nome" precisa ser preenchido!',
            'nome.min' => 'O campo "nome" precisa ter no mínimo 3 caracteres!',
            'nome.max' => 'O campo "nome" só pode ter no máximo 40 caracteres!',
            'nome.unique' => 'Esse "nome" já está cadastrado!',
            'telefone.required' => 'O campo "telefone" precisa ser preenchido!',
            'email.email' => 'Utilize um e-mail válido!',
            'motivo_contatos_id.required' => 'O campo "motivo do contato" precisa ser preenchido!',
            'mensagem.required' => 'O campo "mensagem" precisa ser preenchido!',
            'mensagem.max' => 'O campo "mensagem" só pode ter no máximo 2000 caracteres!',
        ];

        /* RECUPERA OS ARRAYS ANTERIORES PARA QUE SEJAM FEITAS AS VALIDAÇÕES */
        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
