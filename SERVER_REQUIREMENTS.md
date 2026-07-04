# Server Tələbləri

## PHP
- Versiya: 8.3+
- Extension-lar: pdo_mysql, mbstring, xml, cURL, json, zip, gd

## MySQL
- Versiya: 8.0+
- Charset: utf8mb4
- Collation: utf8mb4_unicode_ci

## Web Server
- Apache 2.4+ (mod_rewrite aktiv)
- Nginx 1.18+
- LiteSpeed 5.4+

## Memory
- Minimum: 256MB
- Tövsiyə: 512MB+

## Disk
- Minimum: 100MB (kod)
- Tövsiyə: 1GB+ (upload, log)

## PHP Funksiyaları (aktiv olmalı)
- allow_url_fopen
- file_uploads
- mbstring
- openssl
- pdo
- tokenizer
- xml
- cURL

## PHP Funksiyaları (deaktiv olmalı)
- display_errors (production)
