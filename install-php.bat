@echo off
echo Installing PHP for Laravel...
echo.

echo Option 1: Download XAMPP (Recommended)
echo ----------------------------------------
echo XAMPP includes PHP, MySQL, and Apache
echo Download from: https://www.apachefriends.org/download.html
echo.
echo After installing XAMPP:
echo 1. Start XAMPP Control Panel
echo 2. Start Apache and MySQL services
echo 3. PHP will be available at: C:\xampp\php
echo.
echo Option 2: Install PHP Standalone
echo ---------------------------------
echo Download from: https://windows.php.net/download/
echo Choose VC15 x64 Non Thread Safe zip
echo.
echo Manual installation steps:
echo 1. Extract PHP to C:\PHP
echo 2. Add C:\PHP to PATH environment variable
echo 3. Copy php.ini-development to php.ini
echo 4. Enable required extensions in php.ini:
echo    - extension=curl
echo    - extension=fileinfo
echo    - extension=gd
echo    - extension=mbstring
echo    - extension=openssl
echo    - extension=pdo_mysql
echo.
echo Option 3: Use Laravel Herd (Easiest)
echo ------------------------------------
echo Download from: https://herd.laravel.com/
echo Herd is a native Laravel environment for Windows
echo.

pause
