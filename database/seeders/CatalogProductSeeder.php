<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatalogProduct;
use App\Models\GasType;
use App\Models\CylinderCapacity;

class CatalogProductSeeder extends Seeder
{
    public function run(): void
    {
        $air = GasType::where('name', 'AIRE COMPRIMIDO')->firstOrFail();
        $co2 = GasType::where('name', 'DIOXIDO DE CARBONO MEDICINAL')->firstOrFail();
        $o2  = GasType::where('name', 'OXÍGENO MEDICINAL GAS')->firstOrFail();

        $capId = fn(string $name) => CylinderCapacity::where('name', $name)->first()?->id;

        $rows = [
            ['code'=>'00AC','detail'=>'AIRE COMPRIMIDO','gas_type_id'=>$air->id,'capacity_id'=>null,'sanitary_registry'=>'GN-320-09-10'],
            ['code'=>'00DCCARMED','detail'=>'DIOXIDO DE CARBONO','gas_type_id'=>$co2->id,'capacity_id'=>null,'sanitary_registry'=>'GN-414-03-11'],

            ['code'=>'OMG-0,42','detail'=>'OXÍGENO MEDICINAL GAS 0,42 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('0.42 m3'),'sanitary_registry'=>'GN-414-03-11'],
            ['code'=>'OMG-0,68','detail'=>'OXÍGENO MEDICINAL GAS 0,68 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('0.68 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-1','detail'=>'OXÍGENO MEDICINAL GAS 1 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('1 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-2','detail'=>'OXÍGENO MEDICINAL GAS 2 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('2 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-3','detail'=>'OXÍGENO MEDICINAL GAS 3 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('3 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-4','detail'=>'OXÍGENO MEDICINAL GAS 4 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('4 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-5','detail'=>'OXÍGENO MEDICINAL GAS 5 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('5 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-6','detail'=>'OXÍGENO MEDICINAL GAS 6 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('6 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-7','detail'=>'OXÍGENO MEDICINAL GAS 7 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('7 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-8','detail'=>'OXÍGENO MEDICINAL GAS 8 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('8 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-9','detail'=>'OXÍGENO MEDICINAL GAS 9 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('9 m3'),'sanitary_registry'=>'GN-413-03-11'],
            ['code'=>'OMG-10','detail'=>'OXÍGENO MEDICINAL GAS 10 m³','gas_type_id'=>$o2->id,'capacity_id'=>$capId('10 m3'),'sanitary_registry'=>'GN-413-03-11'],
        ];

        foreach ($rows as $r) {
            CatalogProduct::updateOrCreate(['code' => $r['code']], $r);
        }
    }
}
