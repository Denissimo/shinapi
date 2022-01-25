# Для начала указываем исходный образ, он будет использован как основа
FROM php:8-fpm
# Необязательная строка с указанием автора образа
MAINTAINER PHPtoday.ru <info@phptoday.ru>

# RUN выполняет идущую за ней команду в контексте нашего образа.
# В данном случае мы установим некоторые зависимости и модули PHP.
# Для установки модулей используем команду docker-php-ext-install.
# На каждый RUN создается новый слой в образе, поэтому рекомендуется объединять команды.
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
                 icu-devtools \
                 libicu-dev \
                 libmcrypt4 \
                 libmcrypt-dev \
                 libpng-dev \
                 zlib1g-dev \
                 libxml2-dev \
                 libzip-dev \
#        libmcrypt-dev \
#        libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd

#     && docker-php-ext-install -j$(nproc) iconv mcrypt mbstring mysqli pdo_mysql zip \
    #RUN apt-get update \
#  && apt-get install -y \
#             apt-utils \
#             man \
#             curl \
#             git \
#             bash \
#             vim \
#             zip unzip \
#             acl \
#             iproute2 \
#             dnsutils \
#             fonts-freefont-ttf \
#             fontconfig \
#             dbus \
#             openssh-client \
#             sendmail \
#             libfreetype6-dev \
#             libjpeg62-turbo-dev \
#             icu-devtools \
#             libicu-dev \
#             libmcrypt4 \
#             libmcrypt-dev \
#             libpng-dev \
#             zlib1g-dev \
#             libxml2-dev \
#             libzip-dev \
#             libonig-dev \
#             graphviz \
#             libcurl4-openssl-dev \
#             pkg-config \
#             libldap2-dev \
#             libpq-dev \
#        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#        && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl --enable-intl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install pdo \
#        pgsql pdo_pgsql \
        mysqli pdo_mysql \
        intl iconv mbstring \
        zip pcntl \
        exif opcache \
    && docker-php-source delete \

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Добавим свой php.ini, можем в нем определять свои значения конфига
#ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]