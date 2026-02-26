@extends('layouts.app')

@section('title', 'Busca de CEP')

@section('content')
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
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="bi bi-search"></i>Buscar endereco
                            </button>
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
