<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Facility::create([
            'name' => 'Basketball Court A',
            'address' => 'Shibuya',
            'description' => '広いバスケットボールコート',
            'price_per_hour' => 5000,
            'category' => 'basketball',
        ]);
        Facility::create([
            'name' => 'Basketball Court B',
            'address' => 'Osaki',
            'description' => '本格的なコート',
            'price_per_hour' => 3000,
            'category' => 'basketball',
        ]);
    }
}
