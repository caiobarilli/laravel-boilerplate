# Laravel Boilerplate

Boilerplate com Laravel com Livewire, Jetstream, Maryui & Powergrid

# Instalação

Instale as dependências do composer e do npm

```bash
composer install
```

```bash
npm install
```

Crie o arquivo .env e configure o banco de dados

```bash
cp .env.example .env
```

Gere a chave do projeto

```bash
php artisan key:generate
```

Rode as migrações e as seeds

```bash
php artisan migrate:fresh --seed
```

Para rodar o projeto

```bash
php artisan serve
```

```bash
npm run dev
```

ou

```bash
npm run build
```
