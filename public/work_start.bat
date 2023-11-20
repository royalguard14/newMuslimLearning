@echo off
cd C:\xampp7427\htdocs\sirhv2\
php artisan queue:restart
php artisan queue:work --tries=1
cmd /k 