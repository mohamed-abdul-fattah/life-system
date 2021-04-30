FROM php:7.4.15-cli

ARG DEBIAN_FRONTEND=noninteractive
ARG APP_PATH=/app

RUN apt-get -q update && \
    apt-get install -yq --no-install-recommends \
        # Used by composer to cache packages
        libzip-dev zip unzip \
        curl \
        build-essential && \
    docker-php-ext-install mysqli zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --quiet && \
    mv composer.phar /usr/local/bin/composer

# Install NodeJs
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs

RUN mkdir -p ${APP_PATH}

COPY . ${APP_PATH}
COPY entrypoint.sh /tmp/entrypoint.sh

RUN chmod +x /tmp/entrypoint.sh

WORKDIR ${APP_PATH}
