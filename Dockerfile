FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    libpq-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --optimize-autoloader

EXPOSE 10000

CMD php artisan migrate --force && php artisan config:cache && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT