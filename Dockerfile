FROM php:8.2-cli

# Установка системных пакетов и Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка рабочей директории
WORKDIR /app

# Копируем проект внутрь контейнера
COPY . .

# Устанавливаем зависимости проекта
RUN composer install --no-interaction --prefer-dist

# Устанавливаем дефолтную команду: запуск тестов
# Работает с phpunit.xml, либо указывает директорию явно
CMD ["vendor/bin/phpunit", "--testdox", "tests"]
