# Eficaz Eventos

Sistema de gestão de eventos com inscrições, desenvolvido em Laravel + Blade como avaliação técnica (Eficaz Marketing).

## Funcionalidades

- CRUD de eventos (criar, listar, editar, excluir)
- Inscrição em eventos pelo usuário
- Cancelamento da própria inscrição
- Página "Minhas Inscrições"
- Lista de inscritos por evento (acessível ao criador)
- Regras de negócio aplicadas na inscrição:
    - bloqueia inscrição duplicada
    - bloqueia inscrição em evento lotado (quando há capacidade definida)
    - bloqueia inscrição em evento já passado
- Autenticação via Laravel Breeze (Blade)

## Requisitos

- PHP 8.4+
- Composer 2+
- Node 20+ / npm
- MySQL 8+

Configure as variáveis de banco no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eficaz
DB_USERNAME=laravel
DB_PASSWORD=root
```

```bash
# 3. rodar migrations e seeders
php artisan migrate --seed

# 4. buildar assets
npm run build

# 5. servir aplicação
php artisan serve
```

Acesse http://localhost:8000.

## Padronização de código

```bash
./vendor/bin/pint
```
