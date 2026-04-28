# Используем официальный образ PHP с FPM
FROM php:8.4-fpm

# Устанавливаем системные зависимости и PostgreSQL драйвер
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Node.js 22 (нужен для Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем скрипт запуска
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Копируем файлы проекта
COPY . .

# Команда запуска
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
