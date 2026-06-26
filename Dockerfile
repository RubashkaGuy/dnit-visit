# syntax=docker/dockerfile:1.7

# ---------- Stage 1: build frontend assets with Vite ----------
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install --no-audit --no-fund
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

# ---------- Stage 2: install PHP dependencies ----------
FROM composer:2 AS vendor
WORKDIR /app
COPY . .
RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    --ignore-platform-reqs

# ---------- Stage 3: runtime (PHP 8.3 + Apache) ----------
FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libjpeg-dev libfreetype6-dev \
        libzip-dev libonig-dev libsqlite3-dev \
        libicu-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo pdo_sqlite gd zip bcmath intl opcache \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

# Document root -> public/, Apache listens on $PORT (Railway provides it)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && printf "<Directory ${APACHE_DOCUMENT_ROOT}>\n    AllowOverride All\n    Require all granted\n</Directory>\n" >> /etc/apache2/apache2.conf

# Production php.ini + sane opcache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && { \
        echo "memory_limit=512M"; \
        echo "upload_max_filesize=20M"; \
        echo "post_max_size=20M"; \
        echo "opcache.enable=1"; \
        echo "opcache.memory_consumption=128"; \
        echo "opcache.interned_strings_buffer=16"; \
        echo "opcache.max_accelerated_files=10000"; \
        echo "opcache.validate_timestamps=0"; \
    } > "$PHP_INI_DIR/conf.d/zz-app.ini"

WORKDIR /var/www/html

COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

# Storage dirs + sqlite stub. Mount a Railway volume on /var/www/html/database
# (and ideally /var/www/html/storage) to persist data across deploys.
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs database \
    && [ -f database/database.sqlite ] || touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R ug+rwX storage bootstrap/cache database

EXPOSE 8080

# Start: prep env, run migrations, cache config/routes/views, then Apache on $PORT.
CMD ["sh", "-c", "\
  set -e; \
  PORT=\"${PORT:-8080}\"; \
  sed -ri \"s!^Listen [0-9]+\\$!Listen ${PORT}!\" /etc/apache2/ports.conf; \
  sed -ri \"s!<VirtualHost \\*:[0-9]+>!<VirtualHost *:${PORT}>!\" /etc/apache2/sites-available/000-default.conf; \
  if [ ! -f .env ]; then cp .env.example .env; fi; \
  if [ -z \"${APP_KEY:-}\" ] && ! grep -q '^APP_KEY=base64:' .env; then php artisan key:generate --force; fi; \
  mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs; \
  chown -R www-data:www-data storage bootstrap/cache database; \
  touch database/database.sqlite; \
  php artisan storage:link --force || true; \
  php artisan migrate --force --no-interaction; \
  php artisan config:cache; \
  php artisan route:cache; \
  php artisan view:cache; \
  exec apache2-foreground \
"]
