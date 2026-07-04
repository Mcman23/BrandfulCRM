# Təhlükəsizlik

## CSRF Qoruması
Bütün POST/PUT/DELETE/PATCH sorğular CSRF token tələb edir.

## XSS Qoruması
Blade templating avtomatik HTML escaping edir. `{{ }}` sintaksisi təhlükəsizdir.

## SQL Injection Qoruması
Eloquent ORM parameter binding istifadə edir. Heç vaxt raw SQL istifadə etməyin.

## Mass Assignment Qoruması
Bütün modellərdə `$fillable` istifadə olunur.

## Rate Limiting
API endpoint-lərində rate limiting aktivdir (60 req/dəq).

## Password Hashing
Bcrypt alqoritmi ilə hash edilir (Hash::make).

## Security Headers
- X-Content-Type-Options: nosniff
- X-Frame-Options: SAMEORIGIN
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin
- HSTS (HTTPS-də)

## Session Security
- HttpOnly cookies
- SameSite cookies
- Encrypted session data

## RBAC (Role-Based Access Control)
- Super Admin: Tam giriş
- Admin: İdarəetmə
- Menecer: Şirkət məlumatları
- Satış əməkdaşı: Məhdud
