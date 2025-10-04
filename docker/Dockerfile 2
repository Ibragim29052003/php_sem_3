# PHP с расширениями для Laravel
FROM php:8.2-fpm

# Устанавливаем Node.js и npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libsqlite3-dev \
    curl zip npm sqlite3

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка Node.js и npm (для Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html

# Копируем проект
COPY . .

# Устанавливаем зависимости Laravel и Node
RUN composer install --no-interaction --prefer-dist \
    && npm install
