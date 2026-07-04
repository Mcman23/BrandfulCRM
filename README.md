# BizCRM - Multi-company B2B CRM Platform

## Haqqında
BizCRM — marketinq və təmizlik şirkətləri üçün nəzərdə tutulmuş, çoxşirkətli B2B CRM platformasıdır. Sistem tam Azərbaycan dilində işləyir.

## Texnologiyalar
- **Backend:** Laravel 12, PHP 8.3+
- **Database:** MySQL 8+
- **Auth:** Laravel Sanctum (API) + Session (Web)
- **Frontend:** Blade + Tailwind CSS
- **Architecture:** MVC, RBAC

## Modullar
1. İdarəetmə Paneli (Dashboard)
2. Şirkətlər (Companies)
3. Müştərilər (Clients)
4. Pipeline (Kanban)
5. Xidmətlər (Services)
6. Satış Paneli (Sales)
7. Geri Dönüşlər (Follow-ups)
8. İstifadəçilər (Users)
9. Tənzimləmələr (Settings)

## Demo Giriş
- **Super Admin:** admin@bizcrm.az / admin123
- **Menecer:** aysel@brandful.az / menecer123
- **Menecer:** leyla@brilliance.az / menecer123

## Qurulum
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan optimize
php artisan serve
```

## Uyğunluq
cPanel, DirectAdmin, Plesk, CyberPanel, Apache, Nginx, LiteSpeed, Docker, VPS, Shared Hosting

## Lisenziya
MIT
