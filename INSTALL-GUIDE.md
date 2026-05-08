# 🚀 Laravel Dashboard Installation Guide

## 📋 Problem
PHP is not installed on your system. You need to install PHP to run the Laravel application.

## 🔧 Solution Options

### Option 1: XAMPP (Recommended for Beginners)
1. **Download XAMPP**: https://www.apachefriends.org/download.html
2. **Install** with default settings
3. **Start XAMPP Control Panel**
4. **Start Apache and MySQL services**
5. **Open Command Prompt** and run:
   ```cmd
   C:\xampp\php\php.exe artisan serve
   ```

### Option 2: Laravel Herd (Easiest)
1. **Download Laravel Herd**: https://herd.laravel.com/
2. **Install** (automatically sets up PHP + MySQL)
3. **Right-click project folder** → "Serve in Herd"

### Option 3: PHP Standalone
1. **Download PHP**: https://windows.php.net/download/
   - Choose: VS16 x64 Non Thread Safe
2. **Extract** to `C:\PHP`
3. **Add to PATH**: `C:\PHP`
4. **Install Composer**: https://getcomposer.org/download/
5. **Run**:
   ```cmd
   composer install
   php artisan serve
   ```

## 🎯 Quick Start Commands

### After XAMPP Installation:
```cmd
# Navigate to project
cd C:\antigravity\website-sekolah-main

# Install dependencies
C:\xampp\php\php.exe composer.phar install

# Start server
C:\xampp\php\php.exe artisan serve
```

### After Laravel Herd Installation:
```cmd
# Right-click project folder → "Serve in Herd"
# Dashboard opens automatically at http://localhost
```

## 🌐 Access Dashboard
Once running, visit: **http://localhost:8000**

## 📱 Features Available
- ✅ Modern UI with animations
- ✅ Interactive charts (attendance, class distribution)
- ✅ Role-based dashboard (admin/kepsek/guru)
- ✅ Responsive design for mobile
- ✅ Real-time clock
- ✅ Quick actions menu
- ✅ Activity feeds

## 🔧 Troubleshooting

### "php not recognized" error:
- Install one of the options above
- Restart terminal after installation
- Use full path: `C:\xampp\php\php.exe`

### Composer issues:
```cmd
# Install composer locally
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar install
```

### Database connection:
- Start MySQL in XAMPP Control Panel
- Check .env file for database settings
- Run: `php artisan migrate`

## 📞 Need Help?
If you're still having trouble, try Laravel Herd - it's the most beginner-friendly option!
