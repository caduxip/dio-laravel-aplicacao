@extends('layouts.app')

@section('title', 'Listagem de Enderecos')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h4 mb-0">Listagem de Enderecos</h1>
                        </div>
                        <p class="text-muted mb-4">Lista de todos os enderecos cadastrados.</p>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                            <a href="{{ route('adicionar') }}" class="btn btn-success mb-2 mb-md-0">
                                <i class="bi bi-plus-circle"></i>Adicionar
                            </a>
                            <span class="badge badge-primary badge-pill px-3 py-2 align-self-start align-self-md-auto">
                                {{ count($enderecos) }} registro(s)
                            </span>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(count($enderecos) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-nowrap">ID</th>
                                            <th class="text-nowrap">CEP</th>
                                            <th>Logradouro</th>
                                            <th class="text-nowrap">Numero</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th class="text-nowrap">UF</th>
                                            <th class="text-nowrap">Data de registro</th>
                                            <th class="text-nowrap">Acoes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enderecos as $endereco)
                                            <tr>
                                                <td>{{ $endereco->id }}</td>
                                                <td class="text-nowrap">{{ $endereco->cep }}</td>
                                                <td>{{ $endereco->logradouro }}</td>
                                                <td>{{ $endereco->numero }}</td>
                                                <td>{{ $endereco->bairro }}</td>
                                                <td>{{ $endereco->cidade }}</td>
                                                <td class="text-uppercase">{{ $endereco->estado }}</td>
                                                <td class="text-nowrap">{{ optional($endereco->created_at)->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <a href="{{ route('enderecos.editar', ['id' => $endereco->id]) }}" class="btn btn-sm btn-outline-primary mb-1 mb-md-0 mr-md-1">
                                                            <i class="bi bi-pencil-square"></i>Editar
                                                        </a>
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-outline-danger btn-excluir"
                                                            data-toggle="modal"
                                                            data-target="#confirmarExclusaoModal"
                                                            data-id="{{ $endereco->id }}"
                                                            data-cep="{{ $endereco->cep }}"
                                                            data-action="{{ route('enderecos.excluir', ['id' => $endereco->id], false) }}"
                                                        >
                                                            <i class="bi bi-trash"></i>Excluir
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                Nenhum endereco cadastrado ate o momento.
                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" role="dialog" aria-labelledby="confirmarExclusaoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmarExclusaoLabel"><i class="bi bi-exclamation-triangle"></i>Confirmar exclusao</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este endereco?
                    <div class="mt-2 text-muted" id="exclusaoReferencia"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="bi bi-x-circle"></i>Cancelar
                    </button>
                    <form id="formExclusao" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            var botoesExcluir = document.querySelectorAll('.btn-excluir');
            var formExclusao = document.getElementById('formExclusao');
            var exclusaoReferencia = document.getElementById('exclusaoReferencia');

            if (!botoesExcluir.length || !formExclusao || !exclusaoReferencia) return;

            botoesExcluir.forEach(function (botao) {
                botao.addEventListener('click', function () {
                    var id = botao.getAttribute('data-id');
                    var cep = botao.getAttribute('data-cep');
                    var action = botao.getAttribute('data-action');

                    formExclusao.setAttribute('action', action);
                    exclusaoReferencia.textContent = 'CEP: ' + cep + ' (ID: ' + id + ')';
                });
            });
        })();
    </script>
@endsection
