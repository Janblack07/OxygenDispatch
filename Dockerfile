# ---- Base PHP ----
FROM php:8.2-cli AS app

# System deps + Node (para Vite)
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    nodejs npm \
 && docker-php-ext-install pdo pdo_mysql zip intl \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy code
COPY . .

# Install PHP deps (prod)
RUN composer install --no-dev --optimize-autoloader

# Build front assets (Vite)
RUN npm ci && npm run build

# Permissions (Laravel needs these)
RUN chmod -R 775 storage bootstrap/cache || true

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 10000
CMD ["/start.sh"]
