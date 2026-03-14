<?php

namespace App\Enums;

enum EntityType: int
{
    case ENTIDAD = 1;
    case INTRADOMICILIARIO_IESS = 2;
    case NO_AFILIADO_APOYO = 3;

    public function label(): string
    {
        return match ($this) {
            self::ENTIDAD => 'Entidad',
            self::INTRADOMICILIARIO_IESS => 'Intradomiciliario IESS',
            self::NO_AFILIADO_APOYO => 'No afiliado / Apoyo',
        };
    }
}
