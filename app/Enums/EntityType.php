<?php

namespace App\Enums;

enum EntityType: int
{
    case PUBLICA = 1;
    case PRIVADA = 2;

    public function label(): string
    {
        return match ($this) {
            self::PUBLICA => 'Pública',
            self::PRIVADA => 'Privada',
        };
    }
}
