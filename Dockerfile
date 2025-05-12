FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройка рабочей директории
WORKDIR /var/www

# Копирование файлов composer
COPY composer.json composer.lock ./

# Копирование остальных файлов проекта
COPY . .

# Установка прав доступа
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Создание необходимых директорий и установка прав
RUN mkdir -p /var/www/storage/framework/{sessions,views,cache} && \
    chmod -R 775 /var/www/storage/framework

# Настройка пользователя
RUN usermod -u 1000 www-data
USER www-data

# Открытие порта PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
