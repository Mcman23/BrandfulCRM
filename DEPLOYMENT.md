# Deployment Təlimatı

## cPanel-a qurulum

1. **ZIP faylını yükləyin** və cPanel File Manager-a upload edin
2. **Public_html qovluğuna extract edin**
3. **MySQL Database yaradın** (cPanel > MySQL Databases)
4. **.env faylını konfiqurasiya edin:**
   - DB_DATABASE, DB_USERNAME, DB_PASSWORD dəyərlərini daxil edin
5. **Terminaldan (SSH və ya cPanel Terminal) işə salın:**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan storage:link
   php artisan migrate --seed
   php artisan optimize
   ```

## DirectAdmin-a qurulum
Eyni cPanel kimi, sadəcə database yaradın və .env konfiqurasiya edin.

## VPS-a qurulum (Ubuntu)
```bash
sudo apt install php8.3 php8.3-mysql php8.3-mbstring php8.3-xml php8.3-curl
composer install --optimize-autoloader --no-dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan optimize
```

## Nginx konfiqurasiyası
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/bizcrm/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

## Apache konfiqurasiyası
`.htaccess` faylının public qovluğunda olduğundan əmin olun.

## Docker ilə
```bash
docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```
