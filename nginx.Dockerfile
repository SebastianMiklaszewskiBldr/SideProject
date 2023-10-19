ARG IMAGE_TAG
FROM nginx:${IMAGE_TAG}

COPY ./config/nginx.conf.example /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html/api/