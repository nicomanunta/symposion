<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventDressCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dress_codes = ['Casual', 'Formale', 'Elegante', 'Abbigliamento Mare', 'Tema Specifco', 'Tema Colore', 'No Dress Code', 'Altro'];

        foreach($dress_codes as $dress_code){
            DB::table('event_dress_codes')->insert([
                'dress_code_name' => $dress_code,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
