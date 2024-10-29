echo "Limpando cache do Laravel..."

# Limpar cache de configuração
php artisan config:clear

# Limpar cache de rota
php artisan route:clear

# Limpar cache de view
php artisan view:clear

# Limpar cache de eventos
php artisan event:clear

# Limpar cache de sessão
php artisan cache:clear

# Limpar cache de configuração
php artisan clear-compiled

# Limpar cache de configuração
php artisan optimize

# Limpar cache de configuração
php artisan route:cache

# Limpar cache de configuração
php artisan config:cache

# Limpar cache do pacote de aplicações
composer clear-cache

# Remover arquivos de cache
rm bootstrap/cache/services.php
rm bootstrap/cache/config.php
rm bootstrap/cache/routes.php
rm bootstrap/cache/packages.php
rm storage/framework/views/*.php

# Criar diretórios
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views

# Limpar cache do Redis
redis-cli flushall

echo "Cache limpo com sucesso."
