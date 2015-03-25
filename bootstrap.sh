#! /usr/bin/env bash

# local variables
APPENV=vagrant
DBHOST=localhost
DBNAME=beardshop
DBUSER=dbuser
DBPASSWD=123

echo -e "\n- Start installing\n"

echo -e "\n-- Updating packages list\n"
apt-get -qq update

echo -e "\n-- Export environment variables locally for artisan\n"
export APP_ENV=$APPENV
export DB_HOST=$DBHOST
export DB_NAME=$DBNAME
export DB_USER=$DBUSER
export DB_PASS=$DBPASSWD

echo -e "\n-- Install base packages\n"
apt-get -y install curl build-essential python-software-properties git > /dev/null 2>&1

echo -e "\n-- Add some repos to update our distro\n"
add-apt-repository ppa:ondrej/php5 > /dev/null 2>&1
add-apt-repository ppa:chris-lea/node.js > /dev/null 2>&1

echo -e "\n-- Updating packages list\n"
apt-get -qq update

echo -e "\n-- Install MySQL specific packages and settings\n"
echo "mysql-server mysql-server/root_password password $DBPASSWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections
apt-get -y install mysql-server-5.5 phpmyadmin > /dev/null 2>&1

echo -e "\n-- Setting up our MySQL user and db\n"
mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME"
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'"

echo -e "\n-- Installing PHP-specific packages\n"
apt-get -y install php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt php5-mysql php-apc > /dev/null 2>&1

echo -e "\n-- Enabling mod-rewrite\n"
a2enmod rewrite > /dev/null 2>&1

echo -e "\n-- Allowing Apache override to all\n"
sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

echo -e "\n-- Setting document root to public directory\n"
rm -rf /var/www
ln -fs /vagrant/public /var/www

echo -e "\n-- We definitly need to see the PHP errors, turning them on\n"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

echo -e "\n-- Turn off disabled pcntl functions so we can use Boris\n"
sed -i "s/disable_functions = .*//" /etc/php5/cli/php.ini

echo -e "\n-- Enable PHP short tags\n"
sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php5/apache2/php.ini

echo -e "\n-- Configure Apache to use phpmyadmin\n"
echo -e "\n\nListen 81\n" >> /etc/apache2/ports.conf
cat > /etc/apache2/conf-available/phpmyadmin.conf << "EOF"
<VirtualHost *:81>
ServerAdmin webmaster@localhost
DocumentRoot /usr/share/phpmyadmin
DirectoryIndex index.php
ErrorLog ${APACHE_LOG_DIR}/phpmyadmin-error.log
CustomLog ${APACHE_LOG_DIR}/phpmyadmin-access.log combined
</VirtualHost>
EOF
a2enconf phpmyadmin > /dev/null 2>&1

echo -e "\n-- Add environment variables to Apache\n"
cat > /etc/apache2/sites-enabled/000-default.conf <<EOF
<VirtualHost *:80>
DocumentRoot /var/www
ErrorLog \${APACHE_LOG_DIR}/error.log
CustomLog \${APACHE_LOG_DIR}/access.log combined
SetEnv APP_ENV $APPENV
SetEnv DB_HOST $DBHOST
SetEnv DB_NAME $DBNAME
SetEnv DB_USER $DBUSER
SetEnv DB_PASS $DBPASSWD
</VirtualHost>
EOF

echo -e "\n-- Restarting Apache\n"
service apache2 restart > /dev/null 2>&1

echo -e "\n-- Installing Composer for PHP package management\n"
curl --silent https://getcomposer.org/installer | php > /dev/null 2>&1
mv composer.phar /usr/local/bin/composer

echo -e "\n-- Installing NodeJS and NPM\n"
apt-get -y install nodejs > /dev/null 2>&1
curl --silent https://npmjs.org/install.sh | sh > /dev/null 2>&1

echo -e "\n-- Installing NPM modules\n"
npm i -g gulp bower > /dev/null 2>&1

echo -e "\n-- Updating project components\n"
cd /vagrant
sudo -u vagrant -H sh -c "composer install" > /dev/null 2>&1
cd /vagrant/public
sudo -u vagrant -H sh -c "bower install" > /dev/null 2>&1

echo -e "\n-- Set fs permissions\n"
#sudo chmod -R 777 /vagrant/app/storage/
sudo -u vagrant -H sh -c "chmod -R 777 /vagrant/app/storage/"

echo -e "\n-- Creating a symlink for future phpunit use\n"
ln -fs /vagrant/vendor/bin/phpunit /usr/local/bin/phpunit

echo -e "\n-- Migrations and seeds\n"
cd /vagrant
php artisan migrate --env=$APPENV > /dev/null 2>&1
php artisan db:seed --env=$APPENV > /dev/null 2>&1