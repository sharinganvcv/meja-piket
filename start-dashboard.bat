@echo off
echo ========================================
echo     Laravel Dashboard Starter
echo ========================================
echo.

REM Try different PHP locations
set PHP_FOUND=0

if exist "C:\xampp\php\php.exe" (
    echo ✓ Found XAMPP PHP
    set PHP_PATH=C:\xampp\php\php.exe
    set PHP_FOUND=1
)

if exist "D:\xampp\php\php.exe" (
    echo ✓ Found XAMPP PHP (D:)
    set PHP_PATH=D:\xampp\php\php.exe
    set PHP_FOUND=1
)

if exist "C:\PHP\php.exe" (
    echo ✓ Found standalone PHP
    set PHP_PATH=C:\PHP\php.exe
    set PHP_FOUND=1
)

if exist "%LOCALAPPDATA%\Herd\bin\php.exe" (
    echo ✓ Found Laravel Herd PHP
    set PHP_PATH=%LOCALAPPDATA%\Herd\bin\php.exe
    set PHP_FOUND=1
)

if %PHP_FOUND%==0 (
    echo ✗ PHP not found in common locations
    echo.
    echo Please install one of the following:
    echo 1. XAMPP: https://www.apachefriends.org/
    echo 2. Laravel Herd: https://herd.laravel.com/
    echo 3. PHP Standalone: https://windows.php.net/download/
    echo.
    pause
    exit /b 1
)

echo.
echo Checking Laravel requirements...
%PHP_PATH% -v

if not exist "vendor" (
    echo.
    echo Installing Composer dependencies...
    if exist "composer.phar" (
        %PHP_PATH% composer.phar install
    ) else (
        echo Downloading Composer...
        %PHP_PATH% -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        %PHP_PATH% composer-setup.php
        %PHP_PATH% -r "unlink('composer-setup.php');"
        %PHP_PATH% composer.phar install
    )
)

echo.
echo ========================================
echo    Starting Laravel Dashboard
echo ========================================
echo.
echo Dashboard will be available at:
echo http://localhost:8000
echo.
echo Press Ctrl+C to stop the server
echo.

%PHP_PATH% artisan serve
