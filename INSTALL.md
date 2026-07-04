# Qurulum Təlimatı

## Tələblər
- PHP 8.3+
- MySQL 8+
- Composer
- Apache/Nginx/LiteSpeed

## Addım-addım qurulum

### 1. Faylları yükləyin
```bash
git clone https://github.com/Mcman23/BrandfulCRM.git
cd BrandfulCRM
```

### 2. Composer paketlərini quraşdırın
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Environment konfiqurasiyası
```bash
cp .env.example .env
php artisan key:generate
```

### 4. .env faylını redaktə edin
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bizcrm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Storage link
```bash
php artisan storage:link
```

### 6. Database migration və seed
```bash
php artisan migrate --seed
```

### 7. Optimizasiya
```bash
php artisan optimize
```

### 8. Serveri işə salın
```bash
php artisan serve
```

Sistem http://localhost:8000 ünvanında işləyəcək.

## Demo giriş
- Admin: admin@bizcrm.az / admin123
- Menecer: aysel@brandful.az / menecer123
