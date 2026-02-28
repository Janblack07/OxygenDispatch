<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GasType;
use App\Models\CylinderCapacity;
use App\Models\WarehouseArea;
use App\Models\TechnicalStatus;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // GAS TYPES (solo los gases base, no por capacidad)
        foreach ([
            'AIRE COMPRIMIDO',
            'DIOXIDO DE CARBONO MEDICINAL',
            'OXÍGENO MEDICINAL GAS',
        ] as $name) {
            GasType::firstOrCreate(['name' => $name]);
        }

// CAPACIDADES (incluye 0.42, 0.68 y 1..10)
        $capacities = [
            ['name'=>'0.42 m3','m3'=>0.42],
            ['name'=>'0.68 m3','m3'=>0.68],
            ['name'=>'1 m3','m3'=>1],
            ['name'=>'2 m3','m3'=>2],
            ['name'=>'3 m3','m3'=>3],
            ['name'=>'4 m3','m3'=>4],
            ['name'=>'5 m3','m3'=>5],
            ['name'=>'6 m3','m3'=>6],
            ['name'=>'7 m3','m3'=>7],
            ['name'=>'8 m3','m3'=>8],
            ['name'=>'9 m3','m3'=>9],
            ['name'=>'10 m3','m3'=>10],
        ];

        foreach ($capacities as $cap) {
            CylinderCapacity::firstOrCreate(['name'=>$cap['name']], ['m3'=>$cap['m3']]);
        }

        foreach (['Recepción','Cuarentena','Almacén','Despacho'] as $name) {
            WarehouseArea::firstOrCreate(['name'=>$name]);
        }

        foreach (['Pendiente','Aprobado','Rechazado'] as $name) {
            TechnicalStatus::firstOrCreate(['name'=>$name]);
        }
    }
}
