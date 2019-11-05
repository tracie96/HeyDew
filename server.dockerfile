
FROM nginx:1.17.3-alpine

RUN apk --update add supervisor

RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

RUN rm /var/cache/apk/*

COPY   ./nginx/conf.d/app.conf /etc/nginx/nginx.conf
COPY ./nginx/supervisor-server.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]