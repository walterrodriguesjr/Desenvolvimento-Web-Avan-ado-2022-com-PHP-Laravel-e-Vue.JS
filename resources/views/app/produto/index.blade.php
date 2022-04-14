@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left: auto; margin-right: auto">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <TH>Comprimento</TH>
                            <TH>Altura</TH>
                            <TH>Largura</TH>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{$produto->itemDetalhe->comprimento ?? ''}}</td>
                                <td>{{$produto->itemDetalhe->altura ?? ''}}</td>
                                <td>{{$produto->itemDetalhe->largura ?? ''}}</td>
                                <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td>
                                <td>
                                    <form id="form_{{$produto->id}}" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $produtos->appends($request)->links() }}
                <br>
                {{-- método que mostra o total de registros por página --}}
                {{ $produtos->count() }} - Total de registros por páginas
                <br>
                {{-- método que mostra o total de registros da consulta --}}
                {{ $produtos->total() }} - Total de registros da consulta
                <br>
                {{-- método que mostra o número do primeiro registro da página --}}
                {{ $produtos->firstItem() }} - número do primeiro registro da página
                <br>
                {{-- método que mostra o número do último registro da página --}}
                {{ $produtos->lastItem() }} - número do último registro da página
                <br>
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de
                {{ $produtos->firstItem() }} a
                {{ $produtos->lastItem() }})
            </div>
        </div>

    </div>
@endsection
