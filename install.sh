#Get laravel version
#php artisan --version

#Autoloader Optimization
/opt/plesk/php/7.4/bin/php composer.phar dump-autoload
/opt/plesk/php/7.4/bin/php composer.phar install --optimize-autoloader --no-dev
/opt/plesk/php/7.4/bin/php composer.phar update

/opt/plesk/php/7.4/bin/php artisan cache:clear
/opt/plesk/php/7.4/bin/php artisan view:clear
/opt/plesk/php/7.4/bin/php artisan view:cache
/opt/plesk/php/7.4/bin/php artisan optimize
/opt/plesk/php/7.4/bin/php artisan config:clear

/opt/plesk/php/7.4/bin/php artisan migrate --seed
