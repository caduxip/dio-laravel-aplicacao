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
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-2">Adicionar Endereco</h1>
                        <p class="text-muted mb-4">Preencha os dados abaixo para cadastrar um endereco.</p>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('salvar') }}" novalidate>
                            @csrf
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

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar endereco</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldmvqV0sA0FfDOMU6z7Sk3qxGn8pY/+bexdFv+5" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6WQ6fZOJ3BCsw2P0p/WeNl13u9I+8R" crossorigin="anonymous"></script>
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
</body>
</html>
