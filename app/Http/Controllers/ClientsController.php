<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientsController extends Controller
{


    public function index()
    {
        $busca = request()->get('busca');
        if ($busca != "" && $busca != null) {
            $clients = Client::where('nome', 'LIKE', "%{$busca}%")
                // ->orWhere('sexo', '=', $busca)
                ->orWhere('date_nasc', 'LIKE', "%{$busca}%")
                ->orWhere('telefone', 'LIKE', "%{$busca}%")
                ->orWhere('email', 'LIKE', "%{$busca}%")
                ->get();
        } else {
            $clients = Client::all();
        }
        return view('clients.index', compact('clients'));
    }

    public function create(Request $request)
    {
        $paramPessoa = $request->get('pessoa');
        $pessoa = Client::getPessoa($paramPessoa);
        return view('clients.create', compact('pessoa'));
    }

    public function store(ClientRequest $request)
    {

        $data = $request->all();//pega todos os dados da requisição
        $data['pessoa'] = Client::getPessoa($request->get('pessoa'));
        $data['inadimplente'] = $request->has('inadimplente') ? true : false;

        if ($data['pessoa'] == Client::PESSOA_FISICA){
            $data['date_nasc'] = $this->tratarData($data['date_nasc']);
        }

        Client::create($data);//cria novo cliente com os dado de $data
        return redirect()->route('clients.index');//redireciona para a lista
    }

    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show', compact('client'));

    }

    public function edit($id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Cliente não foi encontrado");
        }
        $pessoa = $client->pessoa;
        return view('clients.edit', compact('client', 'pessoa'));
    }

    public function update(ClientRequest $request, $id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Cliente não foi encontrado");
        }

        $data = $request->all();
        $data['inadimplente'] = $request->has('inadimplente') ? true : false;
        $data['date_nasc'] = $this->tratarData($data['date_nasc']);
        $client->fill($data);
        $client->save();

        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        if (!($client = Client::find($id))) {
            throw new ModelNotFoundException("Não foi possível realizar a exclusão");
        }

        $client->delete();
        return redirect()->route('clients.index');
    }

    protected function tratarData($data)
    {
        //$dataAux = explode('/', $data);
        //$data = $dataAux[2] . '-' . $dataAux[1] . '-' . $dataAux[0];
        //$dataAuxDois = array_reverse($dataAux);
        //$dataAuxTres = implode('-', $dataAuxDois);

        return implode('-', array_reverse(explode('/', $data)));
    }

}
