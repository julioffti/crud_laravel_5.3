@extends('layouts.app')

@section('title')
    - CRUD
@endsection

@section('content')
    <div class="container">
       <!-- <div class="panel panel-info">
            <div class="panel-heading"> <td>{{$client->nome}}</td> </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item"><b>ID:</b> {{$client->id}}</li>
                    <li class="list-group-item"><b>CPF/CNPJ:</b> {{$client->documento}}</li>
                    <li class="list-group-item"><b>Data de nascimento:</b> {{$client->date_nasc}}</li>
                    <li class="list-group-item"><b>Email:</b> {{$client->email}}</li>
                    <li class="list-group-item"><b>Telefone:</b> {{$client->telefone}}</li>
                    <li class="list-group-item"><b>Sexo:</b> {{$client->sexo}}</li>
                </ul>
            </div>
            <div class="panel-footer"><a href="{{route('clients.index')}}" class="btn btn-primary">Voltar</a></div>
        </div> -->
        <div class="panel panel-info">
            <div class="panel-heading"> <td>{{$client->nome}}</td> </div>
            <div class="panel-body">
                <table class="table table-striped" style="margin-bottom: 0;">

                    <tr>
                        <td><b>ID:</b> {{$client->id}}</td>
                    </tr>
                    <tbody>
                    <tr>
                        <td><b>CPF/CNPJ:</b>{{$client->documento_formatted}}</td>
                    </tr>
                    <tr>
                        <td><b>Data de nascimento:</b>{{$client->date_nasc_formatted}}</td>
                    </tr>
                    <tr>
                        <td><b>Email:</b> {{$client->email}}</td>
                    </tr>
                    <tr>
                        <td><b>Telefone:</b> {{$client->telefone}}</td>
                    </tr>
                    <tr>
                        <td><b>Sexo:</b>
                            @if ($client->pessoa == 'fisica')
                                {{ ($client->sexo == 'm' ? 'Masculino' : 'Feminino') }}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer"><a href="{{route('clients.index')}}" class="btn btn-primary">Voltar</a></div>
        </div>
    </div>
@endsection