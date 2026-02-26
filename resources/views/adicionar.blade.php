@extends('layouts.app')

@section('title', !empty($modoEdicao) ? 'Editar Endereco' : 'Adicionar Endereco')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-2">{{ !empty($modoEdicao) ? 'Editar Endereco' : 'Adicionar Endereco' }}</h1>
                        <p class="text-muted mb-4">
                            {{ !empty($modoEdicao) ? 'Atualize os dados do endereco selecionado.' : 'Preencha os dados abaixo para cadastrar um endereco.' }}
                        </p>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="{{ !empty($modoEdicao) ? route('enderecos.atualizar', ['id' => $id]) : route('salvar') }}" novalidate>
                            @csrf
                            @if(!empty($modoEdicao))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="cep" class="font-weight-bold">CEP</label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    id="cep"
                                    name="cep"
                                    placeholder="00000-000"
                                    maxlength="9"
                                    inputmode="numeric"
                                    autocomplete="postal-code"
                                    value="{{ old('cep', $cep ?? request('cep')) }}"
                                >
                                <small class="form-text text-muted">Exemplo: 20550-013 (com ou sem hifen).</small>
                            </div>

                            <div class="form-group">
                                <label for="logradouro" class="font-weight-bold">Logradouro</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="logradouro"
                                    name="logradouro"
                                    placeholder="Rua, Avenida, Travessa..."
                                    maxlength="120"
                                    autocomplete="address-line1"
                                    value="{{ old('logradouro', $logradouro ?? request('logradouro')) }}"
                                >
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="numero" class="font-weight-bold">Numero</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="numero"
                                        name="numero"
                                        placeholder="123"
                                        maxlength="10"
                                        autocomplete="address-line2"
                                        value="{{ old('numero', $numero ?? request('numero')) }}"
                                    >
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="bairro" class="font-weight-bold">Bairro</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="bairro"
                                        name="bairro"
                                        placeholder="Nome do bairro"
                                        maxlength="80"
                                        autocomplete="address-level3"
                                        value="{{ old('bairro', $bairro ?? request('bairro')) }}"
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="cidade" class="font-weight-bold">Cidade</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cidade"
                                        name="cidade"
                                        placeholder="Nome da cidade"
                                        maxlength="80"
                                        autocomplete="address-level2"
                                        value="{{ old('cidade', $cidade ?? request('cidade')) }}"
                                    >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="estado" class="font-weight-bold">Estado (UF)</label>
                                    <input
                                        type="text"
                                        class="form-control text-uppercase"
                                        id="estado"
                                        name="estado"
                                        placeholder="RJ"
                                        maxlength="2"
                                        autocomplete="address-level1"
                                        value="{{ old('estado', $estado ?? request('estado')) }}"
                                    >
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-md-row">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg mb-2 mb-md-0 mr-md-2">
                                    <i class="bi bi-arrow-left"></i>Voltar
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="bi {{ !empty($modoEdicao) ? 'bi-check2-circle' : 'bi-save' }}"></i>{{ !empty($modoEdicao) ? 'Atualizar endereco' : 'Salvar endereco' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            var cepInput = document.getElementById('cep');
            if (!cepInput) return;

            cepInput.addEventListener('input', function (event) {
                var value = event.target.value.replace(/\D/g, '').slice(0, 8);
                if (value.length > 5) {
                    value = value.slice(0, 5) + '-' + value.slice(5);
                }
                event.target.value = value;
            });
        })();
    </script>
@endsection
