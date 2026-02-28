<?php

namespace App\Enums;

enum AppRole: string
{
    case PROGRAMADOR = 'PROGRAMADOR';
    case ADMINISTRADOR = 'ADMINISTRADOR';
    case ENCARGADO = 'ENCARGADO';

    public static function values(): array
    {
        return array_map(fn($e) => $e->value, self::cases());
    }
}
