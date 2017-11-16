@extends('layouts.app')

@section('title')
    - CRUD
@endsection

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">

            <a href="{{route('clients.create')}}" class="btn btn-primary">Novo Cliente</a>
            </br> </br>
        </div>
        <div class="row">

            <form method="GET" action="{{route('clients.store')}}" class="form">

                <div class="form-group">
                    <label for="busca">Buscar clientes</label>
                    <input class="form-control" name="busca" id="busca" type="text" placeholder="Digite aqui a sua busca">
                    </br>

                    <div class="form-group">
                        <input class="btn btn-primary" value="Buscar cliente" type="submit">
                    </div>
                </div>
                </br>
            </form>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ/CPF</th>
                    <th>Data Nasc</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Sexo</th>
                    <th>Deficiencia</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>


                @foreach($clients as $client)

                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->nome}}</td>
                        <td>{{$client->documento_formatted}}</td>
                        <td>{{$client->date_nasc_formatted}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->telefone}}</td>
                        <td>
                            @if ($client->pessoa == 'fisica')
                                {{ ($client->sexo == 'm' ? 'Masculino' : 'Feminino') }}
                            @endif
                        </td>
                        <td>
                            @if ($client->pessoa == 'fisica')
                                {{ ($client->deficiencia_fisica == '1' ? 'Nenhuma' : '') }}
                                {{ ($client->deficiencia_fisica == '2' ? 'Visual' : '') }}
                                {{ ($client->deficiencia_fisica == '3' ? 'Auditiva' : '') }}
                                {{ ($client->deficiencia_fisica == '4' ? 'Motora' : '') }}
                                {{ ($client->deficiencia_fisica == '5' ? 'Mental' : '') }}
                                {{ ($client->deficiencia_fisica == '6' ? 'Fisica' : '') }}
                                {{ ($client->deficiencia_fisica == '7' ? 'Multipla' : '') }}
                            @endif
                        </td>


                        <td>
                            <ul class="list-inline list-small">
                                <li> <a href="{{route('clients.show', ['id' => $client->id])}}" class="btn btn-info">Ver</a></li>
                                <li>|</li>
                                <li><a href="{{route('clients.edit', ['client' => $client->id])}}" class="btn btn-info">Editar</a></li>
                                <li>|</li>
                                <li><form method="POST" action="{{route('clients.destroy', ['client' => $client->id])}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                        <button class="btn btn-info " type="submit">Excluir</button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection