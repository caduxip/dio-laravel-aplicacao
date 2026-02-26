<?php

namespace App\Http\Controllers;

use App\Http\Requests\Endereco\SalvarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Models\Endereco;

class EnderecoController extends Controller
{
    //
    public function index()
    {
        
        return view('listagem', [
        'enderecos' => Endereco::all()
    ]);
    }

    public function adicionar()
    {
        return view('busca');
    }



    public function buscar(Request $request)
    {
        $cep = $request->input('cep');

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();

        return view('adicionar', [
            'cep' => $cep,
            'logradouro' => $response['logradouro'] ?? '',
            'numero' => '',
            'bairro' => $response['bairro'] ?? '',
            'cidade' => $response['localidade'] ?? '',
            'estado' => $response['uf'] ?? '',
        ]);
    }

    public function salvar(SalvarRequest $request)
    {
        $endereco = Endereco::create([
            'cep' => $request->input('cep'),
            'logradouro' => $request->input('logradouro'),
            'numero' => $request->input('numero'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
        ]);

        return redirect()->route('home')->with('success', 'Endereço salvo com sucesso!');
    }
}
