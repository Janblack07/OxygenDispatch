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
            ['name' => 'METRODIAL-PORTOVIEJO', 'document' => 'CLIENTE002-002', 'address' => '12 DE MARZO-PORTOVIEJO | PORTOVIEJO'],
            ['name' => 'CORDOVA MARTINEZ EDWIN', 'document' => 'CLIENTE002-003', 'address' => 'LETAMENDI | GUAYAQUIL'],
            ['name' => 'CEVALLOS MORA ATILIO ANTONIO', 'document' => 'CLIENTE002-004', 'address' => 'CHONE | CHONE'],
            ['name' => 'MERA CEDEÑO JOSE RAFAEL', 'document' => 'CLIENTE002-005', 'address' => 'CHONE'],
            ['name' => 'DUEÑAS ZAMBRANO JOSÉ', 'document' => 'CLIENTE002-006', 'address' => 'CHONE | CHONE'],
            ['name' => 'CONVENTO SAN AGUSTIN', 'document' => 'CLIENTE002-007', 'address' => 'AV. CARLOS ALBERTO ARAY Y EMILIO HIDALGO | CHONE'],
            ['name' => 'ROSA VERA VARGAS/NANCY SABANDO', 'document' => 'CLIENTE002-008', 'address' => 'CHONE | CHONE'],
            ['name' => 'LUVI LOOR', 'document' => 'CLIENTE002-009', 'address' => 'CHONE | CHONE'],
            ['name' => 'ROSA GARCIA', 'document' => 'CLIENTE002-010', 'address' => 'CHONE | CHONE'],
            ['name' => 'MERCEDES CASTA', 'document' => 'CLIENTE002-011', 'address' => 'CHONE | CHONE'],
            ['name' => 'JOHOO MOREIRA', 'document' => 'CLIENTE002-012', 'address' => 'CHONE | CHONE'],
            ['name' => 'HOSPITAL SAN ANDRES', 'document' => 'CLIENTE002-013', 'address' => 'FLAVIO ALFARO | MANABI'],
            ['name' => 'NARCISA RODRIGUEZ', 'document' => 'CLIENTE002-014', 'address' => 'CHONE | CHONE'],
            ['name' => 'TERESA CEDEÑO', 'document' => 'CLIENTE002-015', 'address' => 'CHONE | CHONE'],
            ['name' => 'LEONARDO ORMAZA', 'document' => 'CLIENTE002-016', 'address' => 'CHONE | CHONE'],
            ['name' => 'JOSE CASTRO', 'document' => 'CLIENTE002-017', 'address' => 'CHONE | CHONE'],
            ['name' => 'MATEO ANDRADE', 'document' => 'CLIENTE002-018', 'address' => 'CHONE | CHONE'],
            ['name' => 'GEAN CARLOS GONZALES', 'document' => 'CLIENTE002-019', 'address' => 'CHONE | CHONE'],
            ['name' => 'JULIO AVEIGA', 'document' => 'CLIENTE002-020', 'address' => 'CHONE | CHONE'],
            ['name' => 'JOSE ZAMBRANO', 'document' => 'CLIENTE002-021', 'address' => 'CHONE | CHONE'],
            ['name' => 'FRANCISCO PAREDES', 'document' => 'CLIENTE002-022', 'address' => 'CHONE | CHONE'],
            ['name' => 'GUSTAVO ZAMBRANO', 'document' => 'CLIENTE002-023', 'address' => 'CHONE | CHONE'],
            ['name' => 'ALBA ARTEAGA', 'document' => 'CLIENTE002-024', 'address' => 'CHONE | CHONE'],
            ['name' => 'LIDA VERA', 'document' => 'CLIENTE002-025', 'address' => 'CHONE | CHONE'],
            ['name' => 'MIGUEL MENDOZA', 'document' => 'CLIENTE002-026', 'address' => 'CHONE | CHONE'],
            ['name' => 'MATEO MENDOZA', 'document' => 'CLIENTE002-027', 'address' => ''],
            ['name' => 'MANADIALISIS', 'document' => 'CLIENTE002-028', 'address' => ''],
            ['name' => 'DIRECCIÓN DISTRITAL 13D06\nJUNÍN BOLÍVAR SALUD', 'document' => 'CLIENTE002-029', 'address' => ''],
            ['name' => 'GINA GRIJALVA', 'document' => 'CLIENTE002-030', 'address' => ''],
            ['name' => 'MARIA CHAVEZ', 'document' => 'CLIENTE002-031', 'address' => ''],
            ['name' => 'CLINICA SANTA MARTHA', 'document' => 'CLIENTE002-032', 'address' => ''],
            ['name' => 'NARCISA ARTEAGA', 'document' => 'CLIENTE002-033', 'address' => ''],
            ['name' => 'JOSELIN ZAMBRANO', 'document' => 'CLIENTE002-034', 'address' => ''],
            ['name' => 'MILLER AVEIGA', 'document' => 'CLIENTE002-035', 'address' => ''],
            ['name' => 'MAGDALENA FERRIN', 'document' => 'CLIENTE002-036', 'address' => ''],
            ['name' => 'LIA ANDRADE', 'document' => 'CLIENTE002-037', 'address' => ''],
            ['name' => 'IVAN VERA', 'document' => 'CLIENTE002-038', 'address' => ''],
            ['name' => 'PILAR', 'document' => 'CLIENTE002-039', 'address' => ''],
            ['name' => 'RODY RIVERA', 'document' => 'CLIENTE002-040', 'address' => ''],
            ['name' => 'OSWALDO LOOR', 'document' => 'CLIENTE002-041', 'address' => ''],
            ['name' => 'DOMENICA LOOR', 'document' => 'CLIENTE002-042', 'address' => ''],
            ['name' => 'MANUEL JESUS', 'document' => 'CLIENTE002-043', 'address' => ''],
            ['name' => 'JORGE ANDRADE', 'document' => 'CLIENTE002-044', 'address' => ''],
            ['name' => 'WILLIAM INTRIAGO', 'document' => 'CLIENTE002-045', 'address' => ''],
            ['name' => 'RAMON ZAMBRANO', 'document' => 'CLIENTE002-046', 'address' => ''],
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
