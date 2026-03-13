# Base: PHP with extensions and Composer
FROM php:8.5.3-fpm-alpine AS php-base

RUN apk add --no-cache git curl unzip libzip-dev \
    && docker-php-ext-install zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Dev: source mounted at runtime
FROM php-base AS dev

# Production: PHP dependencies
FROM php-base AS php-deps

COPY composer*.json ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Frontend assets
FROM node:24.14.0-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# PHP production runtime
FROM php-base AS app

WORKDIR /var/www

COPY . .
COPY --from=php-deps /var/www/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["docker/entrypoint.sh"]
CMD ["php-fpm"]

# Nginx with static assets baked in
FROM nginx:1.29.6-alpine AS nginx

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=frontend /app/public/build /var/www/public/build
COPY public /var/www/public
