FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
        git \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
        postgresql-dev \
        bash \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo \
        pdo_pgsql \
        zip \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD ["php-fpm"]
