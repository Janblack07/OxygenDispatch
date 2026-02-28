<?php

namespace App\Enums;

enum MovementType: int
{
    case ENTRADA = 1;
    case TRASLADO = 2;
    case SALIDA = 3;
    case CAMBIO_ESTADO_TECNICO = 4;

    public function label(): string
    {
        return match ($this) {
            self::ENTRADA => 'Entrada',
            self::TRASLADO => 'Traslado',
            self::SALIDA => 'Salida',
            self::CAMBIO_ESTADO_TECNICO => 'Cambio estado técnico',
        };
    }
}
