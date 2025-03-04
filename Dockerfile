FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activer mod_rewrite pour le routage MVC
RUN a2enmod rewrite

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier le code source
COPY . /var/www/html

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --no-interaction --optimize-autoloader || true

# Exposer le port 80
EXPOSE 80
