# Utiliser une image officielle PHP avec Apache
FROM php:8.1-apache

# Installer les extensions nécessaires pour Laravel et PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer Apache pour servir Laravel depuis le dossier public
RUN a2enmod rewrite
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Copier les fichiers du projet Laravel
COPY . /var/www/html

# Définir les autorisations pour les dossiers de Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Installer les dépendances Laravel
WORKDIR /var/www/html
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Générer la clé de l'application Laravel
RUN php artisan key:generate

# Exposer le port 80 pour le serveur web
EXPOSE 80

# Commande pour démarrer Apache
CMD ["apache2-foreground"]
