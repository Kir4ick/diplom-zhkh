FROM php:8.3-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Очистка кэша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Копирование файлов проекта
COPY . /var/www

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Создаем пользователя и группу www-data
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Копирование файлов проекта
COPY --chown=www:www . /var/www

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader

# Установка прав
RUN chown -R www:www /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

USER www
