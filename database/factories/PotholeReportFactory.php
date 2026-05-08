<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\PotholeReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class PotholeReportFactory extends Factory
{
    protected $model = PotholeReport::class;

    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'street_name' => fake()->streetName(),
            'severity' => fake()->numberBetween(1, 5),
            'status' => 'reported',
            'description' => fake()->sentence(),
        ];
    }
}
