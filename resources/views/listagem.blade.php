<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de CEP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h4 mb-0">Listagem de Enderecos</h1>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary badge-pill px-3 py-2 mr-2">
                                    {{ count($enderecos) }} registro(s)
                                </span>
                                <a href="{{ route('adicionar') }}" class="btn btn-sm btn-success">Adicionar</a>
                            </div>
                        </div>
                        <p class="text-muted mb-4">Lista de todos os enderecos cadastrados.</p>
                        @if(count($enderecos) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-nowrap">CEP</th>
                                            <th>Logradouro</th>
                                            <th class="text-nowrap">Numero</th>
                                            <th>Bairro</th>
                                            <th>Cidade</th>
                                            <th class="text-nowrap">UF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enderecos as $endereco)
                                            <tr>
                                                <td class="text-nowrap">{{ $endereco->cep }}</td>
                                                <td>{{ $endereco->logradouro }}</td>
                                                <td>{{ $endereco->numero }}</td>
                                                <td>{{ $endereco->bairro }}</td>
                                                <td>{{ $endereco->cidade }}</td>
                                                <td class="text-uppercase">{{ $endereco->estado }}</td>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldmvqV0sA0FfDOMU6z7Sk3qxGn8pY/+bexdFv+5" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6WQ6fZOJ3BCsw2P0p/WeNl13u9I+8R" crossorigin="anonymous"></script>
</body>
</html>
