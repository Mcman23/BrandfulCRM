<?php
namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case ADMIN = 'ADMIN';
    case MENEGER = 'MENEGER';
    case SATIS_EMKDAS = 'SATIS_EMKDAS';

    public function label(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::MENEGER => 'Menecer',
            self::SATIS_EMKDAS => 'Satış əməkdaşı',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::SUPER_ADMIN => 'default',
            self::ADMIN => 'default',
            self::MENEGER => 'secondary',
            self::SATIS_EMKDAS => 'outline',
        };
    }
}

