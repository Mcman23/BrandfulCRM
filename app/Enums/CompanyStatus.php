<?php
namespace App\Enums;

enum CompanyStatus: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Aktiv',
            self::INACTIVE => 'Deaktiv',
        };
    }
}

