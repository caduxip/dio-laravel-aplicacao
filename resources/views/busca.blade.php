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
                        <h1 class="h4 mb-2">Buscar CEP</h1>
                        <p class="text-muted mb-4">Informe o CEP para consultar o endereco.</p>

                        <form method="GET" action="{{ route('buscar') }}">
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
                                    pattern="^\d{5}-?\d{3}$"
                                    autocomplete="postal-code"
                                    value="{{ request('cep') }}"
                                    required
                                >
                                <small class="form-text text-muted">Exemplo: 20550-013 (com ou sem hifen).</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Buscar endereco</button>
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
