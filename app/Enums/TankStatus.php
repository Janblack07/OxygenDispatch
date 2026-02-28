<?php

namespace App\Enums;

enum TankStatus: int
{
    case DISPONIBLE = 1;
    case DESPACHADO = 2;
    case BAJA = 3;

    public function label(): string
    {
        return match ($this) {
            self::DISPONIBLE => 'Disponible',
            self::DESPACHADO => 'Despachado',
            self::BAJA => 'Baja',
        };
    }
}
