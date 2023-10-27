# Default Dockerfile
#
# @link     https://www.hyperf.io
# @document https://hyperf.wiki
# @contact  group@hyperf.io
# @license  https://github.com/hyperf/hyperf/blob/master/LICENSE

FROM hyperf/hyperf:8.1-alpine-v3.18-swoole-v5.0
LABEL maintainer="Hyperf Developers <group@hyperf.io>" version="1.0" license="MIT" app.name="Hyperf"

##
# ---------- env settings ----------
##
# --build-arg timezone=Asia/Shanghai
WORKDIR /opt/www

COPY . .

RUN apk add --update ${PHPIZE_DEPS} boost-dev \
    && pecl install pcov \
    && echo "extension=pcov.so" >> /etc/php81/conf.d/99_php.ini \
    && composer install --optimize-autoloader