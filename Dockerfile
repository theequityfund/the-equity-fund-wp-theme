# See https://github.com/richarvey/nginx-php-fpm/blob/main/docs/versioning.md
FROM richarvey/nginx-php-fpm:2.1.2

RUN apk upgrade && apk update && apk add \
  mysql-client \
  openssl \
  msmtp \
  less \
  tzdata \
  mariadb-connector-c

# Configure msmtp
RUN { \
  echo "account default"; \
  echo "host mailhog"; \
  echo "port 1025"; \
  echo "auto_from on"; \
  } > /etc/msmtprc

# Configure PHP to use msmtp for sending mail
RUN { \
  echo 'sendmail_path = "/usr/bin/msmtp -t -i"'; \
  } > /usr/local/etc/php/conf.d/mail.ini

# Install and configure WP CLI
RUN wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar; \
  chmod +x wp-cli.phar; \
  mv wp-cli.phar /usr/local/bin/; \
  # Workaround for root usage scolding.
  echo -e "#!/bin/bash\n\n/usr/local/bin/wp-cli.phar \"\$@\" --allow-root\n" > /usr/local/bin/wp; \
  chmod +x /usr/local/bin/wp; \
  # Add bash completons for interactive usage.
  wget https://github.com/wp-cli/wp-cli/raw/master/utils/wp-completion.bash; \
  mv wp-completion.bash $HOME; \
  echo -e "source $HOME/wp-completion.bash\n" > $HOME/.bashrc

# Download WordPress core manually (fast & safe)
RUN curl -o wordpress.tar.gz https://wordpress.org/latest.tar.gz && \
    mkdir -p /var/www/html && \
    tar --strip-components=1 -xzf wordpress.tar.gz -C /var/www/html && \
    rm wordpress.tar.gz

# Copy custom configuration files into location expected by nginx-php-fpm.
# See https://github.com/richarvey/nginx-php-fpm/blob/master/docs/nginx_configs.md
COPY docker/conf /var/www/html/conf

# Copy startup scripts into location expected by nginx-php-fpm.
# See https://github.com/richarvey/nginx-php-fpm/blob/master/docs/scripting_templating.md
COPY docker/scripts /var/www/html/scripts

# Copy the rest of this theme into place
COPY themes /var/www/html/wp-content/themes
COPY plugins /var/www/html/wp-content/plugins

# Copy Composer files
COPY composer.json composer.lock auth.json /var/www/html/wp-content/
