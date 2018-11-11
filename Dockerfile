FROM php:7.2-fpm

RUN pecl install xdebug-2.6.0  \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y libpq-dev \
    zip \
    unzip \
    git && docker-php-ext-install \
 pdo pdo_pgsql \
 mbstring

# INSTALL COMPOSER:
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --no-dev --install-dir=/usr/local/bin --filename=composer --snapshot \
&& ln -s /usr/local/bin/composer /usr/local/sbin/composer \
&& rm -f /tmp/composer-setup.*