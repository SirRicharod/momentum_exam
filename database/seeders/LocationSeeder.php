<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Brussels', 'postal_code' => '1000'],
            ['name' => 'Antwerp', 'postal_code' => '2000'],
            ['name' => 'Gent', 'postal_code' => '9000'],
            ['name' => 'Liège', 'postal_code' => '4000'],
            ['name' => 'Genk', 'postal_code' => '3600'],
        ];

        foreach ($cities as $city) {
            Location::create($city);
        }
    }
}
