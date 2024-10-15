FROM php:8.3-cli-alpine

RUN apk add bash \
    && docker-php-source delete

ENV COMPOSER_HOME /.composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-autoloader
RUN install-php-extensions xdebug

COPY docker/php/*.ini $PHP_INI_DIR/conf.d/

CMD ["php", "-a"]
