@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <h3>Novo cliente</h3>
        <h4>{{$pessoa == \App\Client::PESSOA_JURIDICA ? 'Pessoa Júridica': 'Pessoa Física'}}</h4>


        <br/><br/>
        @if($errors->any())
            <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        @endif
        <form method="POST" action="{{route('clients.update', ['client' => $client->id])}}" class="form">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="pessoa" value="{{$pessoa}}">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" name="nome" id="nome" type="text" value="{{old('nome', $client->nome)}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" name="email" id="email" type="email" value="{{old('email', $client->email)}}">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input class="form-control" name="telefone" id="telefone" type="text" value="{{old('telefone', $client->telefone)}}">
            </div>
                @if($pessoa == \App\Client::PESSOA_JURIDICA)
                <div class="form-group">
                    <label for="documento">CNPJ</label>
                    <input class="form-control" name="documento" id="documento" type="text" value="{{old('documento', $client->documento_formatted)}}">
                </div>

                <div class="form-group">
                    <label for="fantasia">Nome Fantasia</label>
                    <input class="form-control" name="fantasia" id="fantasia" type="text" value="{{old('fantasia', $client->fantasia)}}">
                </div>

                <input type="hidden" name="pessoa" value="juridica">
                @else
                <input type="hidden" name="pessoa" value="fisica">

                <div class="form-group">
                    <label for="documento">CPF</label>
                    <input class="form-control" name="documento" id="documento" type="text" value="{{old('documento', $client->documento_formatted)}}">
                </div>

                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" name="estado_civil" id="estado_civil">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::ESTADOS_CIVIS as $key => $value)
                            <option value="{{$key}}"{{old('estado_civil', $client->estado_civil) == $key ? 'selected="selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_nasc">Data Nascimento</label>
                    <input class="form-control" name="date_nasc" id="date_nasc" type="text" value="{{old('date_nasc', $client->date_nasc_formatted)}}">
                </div>

                <div class="form-group">
                    <label for="sexo"> Sexo</label>
                    <select class = "form-control" name="sexo" id="sexo">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::SEXO as $key => $value)
                            <option value="{{$key}}" {{old('sexo', $client->sexo) == $key ? 'selected="selected' : ''}} >{{$value}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="deficiencia_fisica"> Deficiência Fisica</label>
                    <select class = "form-control" name="deficiencia_fisica" id="deficiencia_fisica">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::DEFICIENCIAS as $key => $value)
                            <option value="{{$key}}" {{old('deficiencia_fisica', $client->deficiencia_fisica) == $key ? 'selected="selected' : ''}} >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

            <div class="checkbox">
                <label>
                    <input name="inadimplente" value="1" type="checkbox" {{old('inadimplente', $client->inadimplente)}}>Inadimplente?
                </label>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" value="Salvar edição" type="submit">
            </div>
        </form>
    </div>
</div>
@endsection