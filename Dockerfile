# ---------- 1) Frontend build (Vite) ----------
FROM node:20-alpine AS node_build
WORKDIR /app

# Instala deps JS y compila assets
COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# ---------- 2) PHP runtime ----------
FROM php:8.3-cli-alpine AS app

WORKDIR /app

# Dependencias del sistema (ajusta si usas otras extensiones)
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    mysql-client \
 && docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    mbstring \
    zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiamos el proyecto
COPY . .

# Copiamos los assets compilados por Vite (public/build)
COPY --from=node_build /app/public/build /app/public/build

# Instala dependencias PHP en modo producción
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permisos típicos de Laravel
RUN mkdir -p storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Script de arranque
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

# Railway expone el puerto por $PORT
EXPOSE 8080

CMD ["/app/start.sh"]
