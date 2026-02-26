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
        $endereco = Endereco::where('cep', $request->input('cep'))->first();
        if ($endereco) {
            return redirect()->route('home')->with('error', 'Endereço com este CEP já existe!');
        }

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

    public function editar($id)
    {
        $endereco = Endereco::find($id);

        if (! $endereco) {
            return redirect()->route('home')->with('error', 'Endereço não encontrado.');
        }

        return view('adicionar', [
            'modoEdicao' => true,
            'id' => $endereco->id,
            'cep' => $endereco->cep,
            'logradouro' => $endereco->logradouro,
            'numero' => $endereco->numero,
            'bairro' => $endereco->bairro,
            'cidade' => $endereco->cidade,
            'estado' => $endereco->estado,
        ]);
    }

    public function atualizar(SalvarRequest $request, $id)
    {
        $endereco = Endereco::find($id);

        if (! $endereco) {
            return redirect()->route('home')->with('error', 'Endereço não encontrado.');
        }

        $cepExistente = Endereco::where('cep', $request->input('cep'))
            ->where('id', '!=', $id)
            ->exists();

        if ($cepExistente) {
            return redirect()->back()->withInput()->with('error', 'Endereço com este CEP já existe!');
        }

        $endereco->update([
            'cep' => $request->input('cep'),
            'logradouro' => $request->input('logradouro'),
            'numero' => $request->input('numero'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
        ]);

        return redirect()->route('home')->with('success', 'Endereço atualizado com sucesso!');
    }

    public function excluir($id)
    {
        $endereco = Endereco::find($id);

        if (! $endereco) {
            return redirect()->route('home')->with('error', 'Endereço não encontrado.');
        }

        $endereco->delete();

        return redirect()->route('home')->with('success', 'Endereço excluído com sucesso!');
    }
}
