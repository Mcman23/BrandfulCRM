<?php
namespace App\Enums;

enum ExpenseCategory: string
{
    case NEQLIYYAT = 'NEQLIYYAT';
    case MATERIAL = 'MATERIAL';
    case EMEK_HAQQI = 'EMEK_HAQQI';
    case MARKETINQ = 'MARKETINQ';
    case ICARE = 'ICARE';
    case DIGER = 'DIGER';

    public function label(): string
    {
        return match($this) {
            self::NEQLIYYAT => 'Nəqliyyat',
            self::MATERIAL => 'Material',
            self::EMEK_HAQQI => 'Əmək haqqı',
            self::MARKETINQ => 'Marketinq',
            self::ICARE => 'İcarə',
            self::DIGER => 'Digər',
        };
    }
}
