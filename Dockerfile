FROM webdevops/php-apache-dev:8.1

ENV HOME=/app
ENV WEB_DOCUMENT_ROOT=/app

WORKDIR /app

COPY . /app

RUN echo "application:access_u8tg6f76t5drd_" | chpasswd

RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/php.ini
RUN echo "xdebug.client_port=1998" >> /usr/local/etc/php/conf.d/php.ini
