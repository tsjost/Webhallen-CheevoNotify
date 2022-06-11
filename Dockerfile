FROM php:8-cli

ENV TZ=Europe/Stockholm

RUN apt update && apt install -y \
	libcurl4-openssl-dev \
	libicu-dev \
	cron \
	&& docker-php-ext-install curl intl

COPY cronjob.php /app/

COPY cronjob /etc/cron.d/cronjob
RUN chmod 0644 /etc/cron.d/cronjob
RUN crontab /etc/cron.d/cronjob

CMD printenv > /etc/environment ; exec cron -f
