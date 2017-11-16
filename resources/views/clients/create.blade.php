@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <h3>Novo cliente</h3>
        <h4>{{$pessoa == \App\Client::PESSOA_JURIDICA ? 'Pessoa Júridica': 'Pessoa Física'}}</h4>

        <a href="{{ route('clients.create',['pessoa' => \App\Client::PESSOA_FISICA]) }}">Pessoa Física</a> |
        <a href="{{ route('clients.create',['pessoa' => \App\Client::PESSOA_JURIDICA]) }}">Pessoa Jurídica</a>
        <br/><br/>
        @if($errors->any())
            <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        @endif
        <form method="POST" action="{{route('clients.store')}}" class="form">
            {{csrf_field()}}

            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" name="nome" id="nome" type="text" value="{{old('nome')}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" name="email" id="email" type="email" value="{{old('email')}}">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input class="form-control" name="telefone" id="telefone" type="text" value="{{old('telefone')}}">
            </div>
                @if($pessoa == \App\Client::PESSOA_JURIDICA)
                <div class="form-group">
                    <label for="documento">CNPJ</label>
                    <input class="form-control" name="documento" id="documento" type="text" value="{{old('documento')}}">
                </div>

                <div class="form-group">
                    <label for="fantasia">Nome Fantasia</label>
                    <input class="form-control" name="fantasia" id="fantasia" type="text" value="{{old('fantasia')}}">
                </div>

                <input type="hidden" name="pessoa" value="juridica">
                @else
                <input type="hidden" name="pessoa" value="fisica">

                <div class="form-group">
                    <label for="documento">CPF</label>
                    <input class="form-control" name="documento" id="documento" type="text" value="{{old('documento')}}">
                </div>

                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" name="estado_civil" id="estado_civil">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::ESTADOS_CIVIS as $key => $value)
                            <option value="{{$key}}"{{old('estado_civil') == $key ? 'selected="selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_nasc">Data Nascimento</label>
                    <input class="form-control" name="date_nasc" id="date_nasc" type="text" value="{{old('date_nasc')}}">
                </div>

                <div class="form-group">
                    <label for="sexo"> Sexo</label>
                    <select class = "form-control" name="sexo" id="sexo">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::SEXO as $key => $value)
                            <option value="{{$key}}" {{old('sexo') == $key ? 'selected="selected' : ''}} >{{$value}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="deficiencia_fisica"> Deficiência Fisica</label>
                    <select class = "form-control" name="deficiencia_fisica" id="deficiencia_fisica">
                        <option value="0">Selectione</option>
                        @foreach(App\Client::DEFICIENCIAS as $key => $value)
                            <option value="{{$key}}" {{old('deficiencia_fisica') == $key ? 'selected="selected' : ''}} >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

            <div class="checkbox">
                <label>
                    <input name="inadimplente" value="1" type="checkbox">Inadimplente?
                </label>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" value="Criar cliente" type="submit">
            </div>
        </form>
    </div>
</div>
@endsection