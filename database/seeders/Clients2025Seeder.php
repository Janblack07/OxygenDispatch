<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class Clients2025Seeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => 'HOSPITAL BASICO CHONE', 'document' => 'CLIENTE002-001', 'address' => 'JUNIN Y BOYACA | CHONE'],
            ['name' => 'HOSPITAL SAN ANDRES', 'document' => 'CLIENTE002-013', 'address' => 'FLAVIO ALFARO | MANABI'],
            ['name' => 'MANADIALISIS', 'document' => 'CLIENTE002-028', 'address' => ''],
            ['name' => 'DIRECCIÓN DISTRITAL 13D06\nJUNÍN BOLÍVAR SALUD', 'document' => 'CLIENTE002-029', 'address' => 'JUNÍN BOLÍVAR'],
            ['name' => 'Distrito De Salud 13D07 Chone - Flavio Alfaro', 'document' => 'CLIENTE002-047', 'address' => 'Chone | Flavio Alfaro'],
        ];

        // Inserta evitando duplicados por "document" (el código del Excel)
        foreach ($clients as $c) {
            Client::updateOrCreate(
                ['document' => $c['document']],
                [
                    'name' => $c['name'],
                    'address' => $c['address'],
                    'phone' => null,
                    'email' => null,
                ]
            );
        }
    }
}
