# Cadastro de Enderecos com Laravel

Aplicacao web para consulta, cadastro, edicao, listagem e exclusao de enderecos a partir de CEP.

## Objetivo

Este projeto demonstra um fluxo CRUD de enderecos com Laravel, integrando consulta de CEP via API externa (ViaCEP) e persistencia em banco MySQL.

## Funcionalidades

- Busca de endereco por CEP via ViaCEP
- Preenchimento automatico do formulario
- Cadastro de novo endereco
- Edicao de endereco existente (reutilizando a mesma view de cadastro)
- Exclusao com confirmacao em modal
- Listagem com total de registros, data de cadastro e acoes por linha
- Mensagens de sucesso/erro no fluxo de usuario

## Stack

- PHP 7.4
- Laravel 7
- MySQL (Docker)
- Nginx (Docker)
- Bootstrap 4.5 + Bootstrap Icons
- Blade Templates (com heranca de layout)

## Estrutura principal

- `app/Http/Controllers/EnderecoController.php`: regras de fluxo (buscar, salvar, editar, atualizar, excluir)
- `app/Http/Requests/Endereco/SalvarRequest.php`: validacoes do formulario
- `app/Http/Models/Endereco.php`: model Eloquent
- `database/migrations/*cria_tabela_enderecos.php`: estrutura da tabela `enderecos`
- `resources/views/layouts/app.blade.php`: layout base
- `resources/views/busca.blade.php`: busca por CEP
- `resources/views/adicionar.blade.php`: cadastro/edicao
- `resources/views/listagem.blade.php`: listagem e acoes

## Requisitos

- Docker
- Docker Compose

## Como executar

1. Suba os containers:

```bash
docker compose up -d --build
```

2. Instale dependencias (se necessario):

```bash
docker compose exec php-fpm composer install
```

3. Execute as migrations:

```bash
docker compose exec php-fpm php artisan migrate
```

4. Acesse no navegador:

- `http://localhost:89`

## Rotas principais

- `GET /` -> listagem de enderecos
- `GET /adicionar` -> tela de busca por CEP
- `GET /buscar` -> consulta CEP e abre formulario preenchido
- `POST /salvar` -> cria endereco
- `GET /enderecos/{id}/editar` -> formulario em modo edicao
- `PUT /enderecos/{id}` -> atualiza endereco
- `DELETE /enderecos/{id}` -> exclui endereco

## Comandos uteis

```bash
# Rodar migracoes
docker compose exec php-fpm php artisan migrate

# Recriar banco do zero
docker compose exec php-fpm php artisan migrate:fresh

# Limpar caches do Laravel
docker compose exec php-fpm php artisan optimize:clear
```

## Observacoes

- O projeto usa `app/Http/Models` para os models (fora do padrao mais novo `app/Models`).
- O fluxo depende do servico `database` no Docker com `DB_HOST=database`.
- Em ambiente Docker interno, use `DB_PORT=3306`.

## Licenca

Projeto para fins de estudo e demonstracao.
