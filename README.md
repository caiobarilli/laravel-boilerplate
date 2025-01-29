# Laravel Boilerplate

Boilerplate com Laravel com Livewire, Jetstream, Maryui & Powergrid

# Utilize o docker para rodar o projeto

Para rodar o projeto com docker, siga as instruções do repositório [DockerLaravel](
https://github.com/caiobarilli/docker-laravel)

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
