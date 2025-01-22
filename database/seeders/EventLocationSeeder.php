<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = ['Interno', 'Esterno', 'Ristorante o Sala Ricevimenti', 'Struttura Alberghiera', 'Struttura Sportiva', 'Luogo Culturale', 'Villa o Proprietà Privata', 'Discoteca o Locale', 'Piscina', 'Spiaggia', 'Parco', 'Altro'];

        foreach($locations as $location){
            DB::table('event_locations')->insert([
                'location_name' => $location,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
