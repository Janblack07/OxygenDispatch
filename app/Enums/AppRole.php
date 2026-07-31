<?php

namespace App\Enums;

enum AppRole: string
{
    case PROGRAMADOR = 'PROGRAMADOR';
    case ADMINISTRADOR = 'ADMINISTRADOR';
    case ENCARGADO = 'ENCARGADO';
    case TECNICO = 'TECNICO';
    case QUIMICO = 'QUIMICO';

    public static function values(): array
    {
        return array_map(
            fn ($role) => $role->value,
            self::cases()
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::PROGRAMADOR => 'Programador',
            self::ADMINISTRADOR => 'Administrador',
            self::ENCARGADO => 'Encargado',
            self::TECNICO => 'Técnico',
            self::QUIMICO => 'Químico',
        };
    }
}
