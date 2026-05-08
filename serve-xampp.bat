@echo off
echo Starting Laravel with XAMPP...
echo.

REM Check if XAMPP is installed
if exist "C:\xampp\php\php.exe" (
    echo Found PHP at C:\xampp\php\php.exe
    set PHP_PATH=C:\xampp\php\php.exe
) else if exist "D:\xampp\php\php.exe" (
    echo Found PHP at D:\xampp\php\php.exe
    set PHP_PATH=D:\xampp\php\php.exe
) else (
    echo XAMPP not found in default locations.
    echo Please install XAMPP first or ensure it's running.
    echo.
    echo Manual steps:
    echo 1. Install XAMPP from https://www.apachefriends.org/
    echo 2. Start XAMPP Control Panel
    echo 3. Start Apache and MySQL services
    echo 4. Run this script again
    pause
    exit /b 1
)

echo.
echo Checking Composer...
if exist "composer.phar" (
    echo Using local composer.phar
    set COMPOSER_CMD=php composer.phar
) else if exist "%LOCALAPPDATA%\Composer\composer.exe" (
    echo Using global composer
    set COMPOSER_CMD=composer
) else (
    echo Composer not found. Installing...
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    set COMPOSER_CMD=php composer.phar
)

echo.
echo Installing dependencies...
%COMPOSER_CMD% install

echo.
echo Starting Laravel server...
%PHP_PATH% artisan serve

pause
